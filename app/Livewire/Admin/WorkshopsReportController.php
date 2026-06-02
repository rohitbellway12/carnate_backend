<?php

namespace App\Livewire\Admin;

use App\Models\WorkShopVendor;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class WorkshopsReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $statusFilter = ''; // subscribed, trial, inactive, all

    public ?int $viewWorkshopId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }

    public function viewWorkshop(int $workshopId): void
    {
        $this->viewWorkshopId = $workshopId;
    }

    private function getDateRange(): array
    {
        $today = now();

        if (!empty($this->fromDate) && !empty($this->toDate)) {
            return [$this->fromDate, $this->toDate];
        }

        return match ($this->filterType) {
            'daily'   => [$today->toDateString(), $today->toDateString()],
            'weekly'  => [$today->startOfWeek()->toDateString(), $today->endOfWeek()->toDateString()],
            'monthly' => [$today->startOfMonth()->toDateString(), $today->endOfMonth()->toDateString()],
            default   => [null, null],
        };
    }

    protected function getBaseQuery()
    {
        [$startDate, $endDate] = $this->getDateRange();

        return WorkShopVendor::query()
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
                        ->orWhere('company_name', 'LIKE', "%$s%")
                        ->orWhere('email', 'LIKE', "%$s%")
                        ->orWhere('mobile_no', 'LIKE', "%$s%");
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                if ($this->statusFilter === 'subscribed') {
                    $q->where('is_subscribe', 1);
                } elseif ($this->statusFilter === 'trial') {
                    $q->where('is_trial', 1)->where('is_subscribe', 0);
                } elseif ($this->statusFilter === 'inactive') {
                    $q->where('is_subscribe', 0)->where('is_trial', 0);
                }
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $workshops = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=workshops-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($workshops) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Vendor Name', 'Company Name', 'Email', 'Mobile', 'City', 'Status', 'Join Date']);

            foreach ($workshops as $index => $w) {
                $status = 'Inactive';
                if ($w->is_subscribe) {
                    $status = 'Subscribed';
                } elseif ($w->is_trial) {
                    $status = 'Trial';
                }

                fputcsv($file, [
                    $index + 1,
                    $w->name . ' ' . $w->lastname,
                    $w->company_name ?? 'N/A',
                    $w->email,
                    $w->mobile_no,
                    $w->cityName ? $w->cityName->name : 'N/A',
                    $status,
                    \Carbon\Carbon::parse($w->created_at)->format('d M Y')
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'workshops-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $workshops = $query->get();

        // Calculate Totals
        $totals = [
            'total' => $workshops->count(),
            'subscribed' => $workshops->where('is_subscribe', 1)->count(),
            'trial' => $workshops->where('is_trial', 1)->where('is_subscribe', 0)->count(),
            'inactive' => $workshops->where('is_subscribe', 0)->where('is_trial', 0)->count(),
        ];

        $pdf = Pdf::loadView('livewire.admin.pdf.workshops-report', [
            'workshops' => $workshops,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'statusFilter' => $this->statusFilter,
            'search' => $this->search,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'workshops-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $workshops = (clone $query)->paginate($this->perPage);

        // Stats calculation
        $allWorkshops = (clone $query)->get();
        $totals = [
            'total' => $allWorkshops->count(),
            'subscribed' => $allWorkshops->where('is_subscribe', 1)->count(),
            'trial' => $allWorkshops->where('is_trial', 1)->where('is_subscribe', 0)->count(),
            'inactive' => $allWorkshops->where('is_subscribe', 0)->where('is_trial', 0)->count(),
        ];

        $detail = null;
        if ($this->viewWorkshopId) {
            $detail = WorkShopVendor::with('cityName')->find($this->viewWorkshopId);
        }

        return view('livewire.admin.workshops-report', [
            'workshops' => $workshops,
            'totals' => $totals,
            'detail' => $detail,
        ]);
    }
}
