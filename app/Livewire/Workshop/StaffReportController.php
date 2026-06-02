<?php

namespace App\Livewire\Workshop;

use App\Models\WorkShopVendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

#[Layout('components.layouts.workshop-app')]
class StaffReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public ?string $status = null;
    public ?string $filterType = null;
    public int $perPage = 10;
    public ?int $viewStaffId = null;

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function viewStaff(int $staffId): void
    {
        $this->viewStaffId = $staffId;
    }

    public function render()
    {
        $baseQuery = WorkShopVendor::query()
            ->with('Role')
            ->where('parent_id', $this->workshopId)
            ->whereNot('user_type', 0)
            ->when($this->search, function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
                        ->orWhere('email', 'LIKE', "%$s%")
                        ->orWhere('mobile_no', 'LIKE', "%$s%")
                        ->orWhereHas('Role', function ($role) use ($s) {
                            $role->where('name', 'LIKE', "%$s%");
                        });
                });
            });

        // 📆 Date Range Filter
        if ($this->fromDate && $this->toDate) {
            $baseQuery->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]);
        }

        // 🗓 Filter Type (daily, weekly, monthly)
        if ($this->filterType === 'daily') {
            $baseQuery->whereDate('created_at', today());
        } elseif ($this->filterType === 'weekly') {
            $baseQuery->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->filterType === 'monthly') {
            $baseQuery->whereMonth('created_at', now()->month);
        }

        // ✅ Status filter
        if ($this->status !== null && $this->status !== '') {
            $baseQuery->where('is_login', $this->status);
        }

        // 👥 Paginate staff
        $staff = (clone $baseQuery)->paginate($this->perPage);

        // 📋 Staff detail with synced filters
        $detail = null;
        if ($this->viewStaffId) {
            $detail = WorkShopVendor::find($this->viewStaffId);
            if ($detail) {
                $labourQuery = DB::table('job_card_extra_charges as l')
                    ->join('job_cards as jc', 'jc.id', '=', 'l.jobcard_id')
                    ->where('jc.user_id', $this->workshopId)
                    ->where('l.machanic_id', $detail->id)
                    ->select(
                        'l.*',
                        'jc.jobcard_number',
                        'jc.customer_name',
                        'jc.vehical_number',
                        'jc.created_at'
                    );
                // 🔹 Apply filters to labour details
                if ($this->fromDate && $this->toDate) {
                    $labourQuery->whereBetween(DB::raw('DATE(jc.created_at)'), [$this->fromDate, $this->toDate]);
                }

                if ($this->filterType === 'daily') {
                    $labourQuery->whereDate('jc.created_at', today());
                } elseif ($this->filterType === 'weekly') {
                    $labourQuery->whereBetween('jc.created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($this->filterType === 'monthly') {
                    $labourQuery->whereMonth('jc.created_at', now()->month);
                }

                $detail->labours = $labourQuery->orderBy('jc.created_at', 'desc')->paginate(10);
            }
        }
        // 📊 Totals (matching filters)
        $allMatchedIds = (clone $baseQuery)->pluck('id');
        $totalStaff = $allMatchedIds->count();

        $totalLabourAmount = (float) DB::table('job_card_extra_charges as l')
            ->join('job_cards as jc', 'jc.id', '=', 'l.jobcard_id')
            ->where('jc.user_id', $this->workshopId)
            ->whereIn('l.machanic_id', $allMatchedIds)
            ->sum(DB::raw('COALESCE(l.amount,0) * COALESCE(l.qty,1)'));

        $totals = [
            'total_staff' => $totalStaff,
            'total_labour_amount' => round($totalLabourAmount, 2),
        ];

        return view('livewire.workshop.staff-report', [
            'staff' => $staff,
            'detail' => $detail,
            'totals' => $totals,
        ]);
    }

    // 📄 PDF Export (same filters applied)
    public function downloadPDF()
    {
        $query = WorkShopVendor::with('Role')
            ->where('parent_id', $this->workshopId)
            ->whereNot('user_type', 0)
            ->when($this->search, function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->whereRaw("CONCAT(name,' ',lastname) like ?", ["%$s%"])
                        ->orWhere('email', 'like', "%{$s}%")
                        ->orWhere('mobile_no', 'like', "%{$s}%")
                        ->orWhereHas('Role', function ($r) use ($s) {
                            $r->where('name', 'like', "%{$s}%");
                        });
                });
            })
            ->when($this->fromDate && $this->toDate, fn($q) =>
                $q->whereBetween(DB::raw('DATE(created_at)'), [$this->fromDate, $this->toDate]))
            ->when($this->status, fn($q) => $q->where('is_login', $this->status))
            ->orderBy('name');

        if ($this->filterType === 'daily') {
            $query->whereDate('created_at', today());
        } elseif ($this->filterType === 'weekly') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->filterType === 'monthly') {
            $query->whereMonth('created_at', now()->month);
        }

        $staff = $query->get();
        // 🔹 Fetch labour totals per staff
    $staffLabourTotals = DB::table('job_card_extra_charges as l')
    ->join('job_cards as jc', 'jc.id', '=', 'l.jobcard_id')
    ->where('jc.user_id', $this->workshopId)
    ->whereIn('l.machanic_id', $staff->pluck('id'))
    ->select(
        'l.machanic_id',
        DB::raw('SUM(COALESCE(l.amount,0) * COALESCE(l.qty,1)) as total_labour')
    )
    ->groupBy('l.machanic_id')
    ->pluck('total_labour', 'machanic_id'); // [machanic_id => total_labour]

        $pdf = Pdf::loadView('livewire.workshop.pdf.staff-report', [
            'staff' => $staff,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
            'staffLabourTotals' => $staffLabourTotals,
        ]);
        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Staff_Report.pdf');
    }
}
