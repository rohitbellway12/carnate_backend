<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\SparePartVendor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.spare-part-app')]
class SalaryReportController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $sparepartId;
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $search = '';
    public int $perPage = 10;
    public string $filterType = '';

    public function mount(): void
    {
        $this->sparepartId = $this->resolveSparepartOwnerId();
        $this->fromDate = null;
        $this->toDate = null;
    }

    private function resolveSparepartOwnerId(): int
    {
        $user = Auth::guard('sparepart')->user();

        return ($user->parent_id && (int) $user->user_type !== 0)
            ? (int) $user->parent_id
            : (int) $user->id;
    }

    private function getDateRange(): array
    {
        $today = now();

        if (!empty($this->fromDate) && !empty($this->toDate)) {
            return [$this->fromDate, $this->toDate];
        }

        return match ($this->filterType) {
            'daily' => [$today->toDateString(), $today->toDateString()],
            'weekly' => [$today->copy()->startOfWeek()->toDateString(), $today->copy()->endOfWeek()->toDateString()],
            'monthly' => [$today->copy()->startOfMonth()->toDateString(), $today->copy()->endOfMonth()->toDateString()],
            default => [null, null],
        };
    }

    private function sumCompletedTargetForStaff(int $staffId, ?string $from, ?string $to): float
    {
        $query = DB::table('countersales')
            ->where('sparepart_id', $this->sparepartId)
            ->where('staff_id', $staffId);

        if ($from && $to) {
            $query->whereBetween(DB::raw('DATE(date)'), [$from, $to]);
        }

        return (float) ($query->selectRaw('COALESCE(SUM(subtotal), 0) as total')->value('total') ?? 0);
    }

    private function buildStaffQuery(?string $from, ?string $to)
    {
        return SparePartVendor::query()
            ->whereNot('user_type', 0)
            ->where('parent_id', $this->sparepartId)
            ->select(['id', 'name', 'lastname', 'salary', 'monthly_target', 'incentives'])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$s}%"]);
            })
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereIn('id', function ($sub) use ($from, $to) {
                    $sub->select('staff_id')
                        ->from('countersales')
                        ->where('sparepart_id', $this->sparepartId)
                        ->whereNotNull('staff_id')
                        ->whereBetween(DB::raw('DATE(date)'), [$from, $to])
                        ->groupBy('staff_id');
                });
            })
            ->orderBy('name');
    }

    private function mapStaffRow(SparePartVendor $member, ?string $from, ?string $to): array
    {
        $completedTarget = $this->sumCompletedTargetForStaff($member->id, $from, $to);
        $monthlyTarget = (float) ($member->monthly_target ?? 0);
        $overTarget = max($completedTarget - $monthlyTarget, 0);
        $rate = (float) ($member->incentives ?? 0) / 100;
        $incentive = round($overTarget * $rate, 2);
        $baseSalary = (float) ($member->salary ?? 0);

        return [
            'id' => $member->id,
            'name' => trim(($member->name ?? '') . ' ' . ($member->lastname ?? '')),
            'base_salary' => $baseSalary,
            'monthly_target' => $monthlyTarget,
            'completed_target' => round($completedTarget, 2),
            'over_target' => round($overTarget, 2),
            'incentive' => $incentive,
            'total_salary' => round($baseSalary + $incentive, 2),
        ];
    }

    public function render()
    {
        [$from, $to] = $this->getDateRange();
        $baseQuery = $this->buildStaffQuery($from, $to);

        $staff = (clone $baseQuery)->paginate($this->perPage);
        $report = $staff->through(fn (SparePartVendor $member) => $this->mapStaffRow($member, $from, $to));

        $allMatchedStaff = (clone $baseQuery)->get();
        $allTotals = $allMatchedStaff->map(fn (SparePartVendor $member) => $this->mapStaffRow($member, $from, $to));

        $totals = [
            'base_salary' => round($allTotals->sum('base_salary'), 2),
            'monthly_target' => round($allTotals->sum('monthly_target'), 2),
            'completed_target' => round($allTotals->sum('completed_target'), 2),
            'over_target' => round($allTotals->sum('over_target'), 2),
            'incentive' => round($allTotals->sum('incentive'), 2),
            'total_salary' => round($allTotals->sum('total_salary'), 2),
            'staff_count' => $allMatchedStaff->count(),
        ];

        return view('livewire.sparepart.report.salary-report', [
            'rows' => $report,
            'totals' => $totals,
        ]);
    }

    public function downloadPDF()
    {
        [$from, $to] = $this->getDateRange();
        $rows = $this->buildStaffQuery($from, $to)
            ->get()
            ->map(fn (SparePartVendor $member) => $this->mapStaffRow($member, $from, $to));

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.salary-report', [
            'rows' => $rows,
            'from' => $from,
            'to' => $to,
            'filterType' => $this->filterType,
            'search' => $this->search,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'salary-report.pdf');
    }
}
