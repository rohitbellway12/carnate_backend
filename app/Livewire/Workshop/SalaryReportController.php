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
class SalaryReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $search = '';
    public int $perPage = 10;
    public string $filterType = '';

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        // By default — no date filter applied
        $this->fromDate = null;
        $this->toDate = null;
    }

    private function getDateRange(): array
{
    $today = now();

    // 🔹 If both fromDate & toDate are filled manually, treat as custom
    if (!empty($this->fromDate) && !empty($this->toDate)) {
        return [$this->fromDate, $this->toDate];
    }

    return match ($this->filterType) {
        'daily'   => [$today->toDateString(), $today->toDateString()],
        'weekly'  => [$today->startOfWeek()->toDateString(), $today->endOfWeek()->toDateString()],
        'monthly' => [$today->startOfMonth()->toDateString(), $today->endOfMonth()->toDateString()],
        default   => [null, null], // 🧠 no date restriction by default
    };
}


    /**
     * Sum completed target for a staff in given range (or all time if no range)
     */
    private function sumCompletedTargetForStaff(int $staffId, ?string $from, ?string $to): float
    {
        $query = DB::table('job_card_extra_charges as jcec')
            ->join('job_cards as jc', 'jc.id', '=', 'jcec.jobcard_id')
            ->where('jc.user_id', $this->workshopId)
            ->where('jcec.machanic_id', $staffId);

        if ($from && $to) {
            $query->whereBetween(DB::raw('DATE(jcec.created_at)'), [$from, $to]);
        }

        return (float) ($query->selectRaw('COALESCE(SUM((jcec.amount * COALESCE(jcec.qty,1))),0) as total')->value('total') ?? 0);
    }

    /**
     * Render Salary Report with filters and totals
     */
    public function render()
    {
        [$from, $to] = $this->getDateRange();

        $baseQuery = WorkShopVendor::query()
            ->whereNot('user_type', 0)
            ->where('parent_id', $this->workshopId)
            ->select(['id', 'name', 'lastname', 'salary', 'monthly_target', 'incentives'])
            // 🔍 Search by staff name
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$s%"]);
            })
            // ✅ Apply date-based filter only if active
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereIn('id', function ($sub) use ($from, $to) {
                    $sub->select('jcec.machanic_id')
                        ->from('job_card_extra_charges as jcec')
                        ->join('job_cards as jc', 'jc.id', '=', 'jcec.jobcard_id')
                        ->where('jc.user_id', Auth::guard('workshop')->user()->id)
                        ->whereBetween(DB::raw('DATE(jcec.created_at)'), [$from, $to])
                        ->groupBy('jcec.machanic_id');
                });
            })
            ->orderBy('name');

        // 🧾 Paginated staff list
        $staff = (clone $baseQuery)->paginate($this->perPage);

        // 💰 Salary Calculations
        $report = $staff->through(function (WorkShopVendor $member) use ($from, $to) {
            $completedTarget = $this->sumCompletedTargetForStaff($member->id, $from, $to);
            $monthlyTarget = (float) ($member->monthly_target ?? 0);
            $overTarget = max($completedTarget - $monthlyTarget, 0);
            $rate = (float) ($member->incentives ?? 0) / 100;
            $incentive = round($overTarget * $rate, 2);
            $baseSalary = (float) ($member->salary ?? 0);
            $totalSalary = $baseSalary + $incentive;

            return [
                'id' => $member->id,
                'name' => trim(($member->name ?? '') . ' ' . ($member->lastname ?? '')),
                'base_salary' => $baseSalary,
                'monthly_target' => $monthlyTarget,
                'completed_target' => round($completedTarget, 2),
                'over_target' => round($overTarget, 2),
                'incentive' => $incentive,
                'total_salary' => round($totalSalary, 2),
            ];
        });

        // 📊 Totals
        $allMatchedStaff = (clone $baseQuery)->get();
        $allTotals = $allMatchedStaff->map(function (WorkShopVendor $member) use ($from, $to) {
            $completedTarget = $this->sumCompletedTargetForStaff($member->id, $from, $to);
            $monthlyTarget = (float) ($member->monthly_target ?? 0);
            $overTarget = max($completedTarget - $monthlyTarget, 0);
            $rate = (float) ($member->incentives ?? 0) / 100;
            $incentive = round($overTarget * $rate, 2);
            $baseSalary = (float) ($member->salary ?? 0);
            $totalSalary = $baseSalary + $incentive;

            return [
                'base_salary' => $baseSalary,
                'monthly_target' => $monthlyTarget,
                'completed_target' => $completedTarget,
                'over_target' => $overTarget,
                'incentive' => $incentive,
                'total_salary' => $totalSalary,
            ];
        });

        $totals = [
            'base_salary' => round($allTotals->sum('base_salary'), 2),
            'monthly_target' => round($allTotals->sum('monthly_target'), 2),
            'completed_target' => round($allTotals->sum('completed_target'), 2),
            'over_target' => round($allTotals->sum('over_target'), 2),
            'incentive' => round($allTotals->sum('incentive'), 2),
            'total_salary' => round($allTotals->sum('total_salary'), 2),
            'staff_count' => $allMatchedStaff->count(),
        ];

        return view('livewire.workshop.salary-report', [
            'rows' => $report,
            'totals' => $totals,
        ]);
    }

    /**
     * Download Filtered PDF
     */
    public function downloadPDF()
    {
        [$from, $to] = $this->getDateRange();

        $baseQuery = WorkShopVendor::query()
            ->whereNot('user_type', 0)
            ->where('parent_id', $this->workshopId)
            ->select(['id','name','lastname','salary','monthly_target','incentives'])
            // 🔍 Search filter
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$s%"]);
            })
            // ✅ Apply date filter if active
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereIn('id', function ($sub) use ($from, $to) {
                    $sub->select('jcec.machanic_id')
                        ->from('job_card_extra_charges as jcec')
                        ->join('job_cards as jc', 'jc.id', '=', 'jcec.jobcard_id')
                        ->where('jc.user_id', Auth::guard('workshop')->user()->id)
                        ->whereBetween(DB::raw('DATE(jcec.created_at)'), [$from, $to])
                        ->groupBy('jcec.machanic_id');
                });
            })
            ->orderBy('name');

        // 🧾 Get filtered data
        $vendors = $baseQuery->get()->map(function ($member) use ($from, $to) {
            $completedTarget = $this->sumCompletedTargetForStaff($member->id, $from, $to);
            $monthlyTarget = (float) ($member->monthly_target ?? 0);
            $overTarget = max($completedTarget - $monthlyTarget, 0);
            $rate = (float) ($member->incentives ?? 0) / 100;
            $incentive = round($overTarget * $rate, 2);
            $baseSalary = (float) ($member->salary ?? 0);
            $totalSalary = $baseSalary + $incentive;

            return [
                'name' => trim(($member->name ?? '') . ' ' . ($member->lastname ?? '')),
                'base_salary' => $baseSalary,
                'monthly_target' => $monthlyTarget,
                'completed_target' => $completedTarget,
                'over_target' => $overTarget,
                'incentive' => $incentive,
                'total_salary' => $totalSalary,
            ];
        });

        // 🧾 Generate PDF
        $pdf = Pdf::loadView('livewire.workshop.pdf.salary-report', [
            'rows' => $vendors,
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
