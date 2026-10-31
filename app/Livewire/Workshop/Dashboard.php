<?php

namespace App\Livewire\Workshop;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\JobCard;
use App\Models\JobCardExtraCharge;
use App\Models\JobCardSparePart;
use App\Models\CounterSale;
use App\Models\CounterSaleSparePart;
use App\Models\ProductStock;
use App\Models\WorkShopVendor;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.workshop-app')]
class Dashboard extends Component
{
    use WithPagination;

    public $workshopId;
    public $daysLeft;
    public $message = '';

    // Core Metrics
    public $monthlyRevenue = 0;
    public $inProcessEstimatedRevenue = 0;
    public $lastMonthRevenue = 0;
    public $revenueGrowthPercent = 0;
    public $activeJobsCount = 0;
    public $openJobsCount = 0;
    public $processJobsCount = 0;
    public $confirmedJobsCount = 0;
    public $completedThisMonth = 0;
    public $totalJobCards = 0;
    public $totalCustomers = 0;
    public $totalStaff = 0;
    public $upcomingAppointmentsCount = 0;
    public $lowStockCount = 0;

    // Charts Data
    public $trendMonths = [];
    public $trendRevenues = [];
    public $trendJobs = [];
    public $statusLabels = [];
    public $statusSeries = [];
    public $revenueSplitLabels = [];
    public $revenueSplitSeries = [];

    // Operational Lists
    public $activeJobCards = [];
    public $upcomingAppointments = [];
    public $lowStockItems = [];

    public function mount()
    {
        $user = Auth::guard('workshop')->user();
        if (!$user) {
            return;
        }

        $this->workshopId = $user->id;
        $ownerId = $user->is_user == 0 ? $user->id : ($user->parent_id ?? $user->id);

        // Subscription check
        $currentDate = Carbon::now('Asia/Kolkata');
        $subscriptionEndDate = Carbon::parse($user->subscription_end_date, 'Asia/Kolkata');
        if ($user->is_trial === 1) {
            $trialStartDate = Carbon::parse($user->trial_start_date, 'Asia/Kolkata');
            $trialEndDate = $trialStartDate->copy()->addDays((int) ($user->trial_days ?? 0));
            $subscriptionEndDate = $trialEndDate;
        }

        $this->daysLeft = (int) $currentDate->diffInDays($subscriptionEndDate, false);

        if ($this->daysLeft <= 15) {
            if (ceil($this->daysLeft) == 0) {
                $this->message = 'Your subscription plan expires today!';
            } elseif ($this->daysLeft < 0) {
                $this->message = 'Your subscription plan expired on ' . $subscriptionEndDate->format('d M Y') . '.';
            } else {
                $this->message = 'Your subscription plan will expire in ' . $this->daysLeft . ' day(s).';
            }
        }

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $startOfLastMonth = now()->subMonth()->startOfMonth();
        $endOfLastMonth = now()->subMonth()->endOfMonth();

        // 1. Monthly Realized Revenue (Strictly from Completed [2] & Closed [3] JobCards + Counter Sales)
        $this->monthlyRevenue = round($this->calculateFinancialRevenue($ownerId, $startOfMonth, $endOfMonth));
        $this->lastMonthRevenue = round($this->calculateFinancialRevenue($ownerId, $startOfLastMonth, $endOfLastMonth));

        // In-Process work on floor (Estimated pipeline value)
        $inProcessJcIds = JobCard::where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->whereIn('status', [0, 4, 1])
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->pluck('id');

        $this->inProcessEstimatedRevenue = round(
            (float) JobCardSparePart::whereIn('jobcard_id', $inProcessJcIds)->sum('final_amount')
            + (float) JobCardExtraCharge::whereIn('jobcard_id', $inProcessJcIds)->sum(DB::raw('COALESCE(amount, charges, 0)'))
        );

        if ($this->lastMonthRevenue > 0) {
            $this->revenueGrowthPercent = round((($this->monthlyRevenue - $this->lastMonthRevenue) / $this->lastMonthRevenue) * 100, 1);
        } else {
            $this->revenueGrowthPercent = $this->monthlyRevenue > 0 ? 100 : 0;
        }

        // 2. Active Jobs In Bays
        $this->openJobsCount = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->where('status', 0)->count();
        $this->processJobsCount = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->where('status', 4)->count();
        $this->confirmedJobsCount = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->where('status', 1)->count();
        $this->activeJobsCount = $this->openJobsCount + $this->processJobsCount + $this->confirmedJobsCount;

        // 3. Completed Jobs & Totals
        $this->completedThisMonth = JobCard::where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->whereIn('status', [2, 3])
            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->count();

        $this->totalJobCards = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->count();
        $this->totalCustomers = Customer::where('user_id', $ownerId)->count();
        $this->totalStaff = WorkShopVendor::whereNot('user_type', 0)->where('parent_id', $ownerId)->count();
        
        $this->upcomingAppointmentsCount = Appointment::where('workshop_id', $ownerId)
            ->whereDate('appointment_date', '>=', now()->toDateString())
            ->count();

        $this->lowStockCount = ProductStock::where('user_id', $ownerId)->where('stock', '<=', 5)->count();

        // 4. Last 6 Months Revenue & Job Cards Trend
        $months = [];
        $revs = [];
        $jobs = [];
        for ($i = 5; $i >= 0; $i--) {
            $dt = now()->subMonths($i);
            $mStart = $dt->copy()->startOfMonth();
            $mEnd = $dt->copy()->endOfMonth();

            $mRev = $this->calculateFinancialRevenue($ownerId, $mStart, $mEnd);

            $mJobs = JobCard::where('user_id', $ownerId)
                ->where('soft_delete', 0)
                ->whereBetween('created_at', [$mStart, $mEnd])
                ->count();

            $months[] = $dt->format('M Y');
            $revs[] = round($mRev);
            $jobs[] = $mJobs;
        }

        $this->trendMonths = $months;
        $this->trendRevenues = $revs;
        $this->trendJobs = $jobs;

        // 5. Job Status Distribution for Donut Chart
        $completedTotal = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->where('status', 2)->count();
        $closedTotal = JobCard::where('user_id', $ownerId)->where('soft_delete', 0)->where('status', 3)->count();

        $this->statusLabels = ['Open', 'In Process', 'Confirmed', 'Completed', 'Closed'];
        $this->statusSeries = [
            $this->openJobsCount,
            $this->processJobsCount,
            $this->confirmedJobsCount,
            $completedTotal,
            $closedTotal,
        ];

        // 6. Revenue Split (Job Cards vs Counter Sales)
        $thisMonthJcIds = JobCard::where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->whereIn('status', [4, 1, 2, 3])
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->pluck('id');

        $jcRev = (float) JobCardSparePart::whereIn('jobcard_id', $thisMonthJcIds)->sum('final_amount')
            + (float) JobCardExtraCharge::whereIn('jobcard_id', $thisMonthJcIds)->sum(DB::raw('COALESCE(amount, charges, 0)'));

        $thisMonthCsIds = CounterSale::where('workshop_id', $ownerId)
            ->whereBetween(DB::raw('DATE(created_at)'), [$startOfMonth->toDateString(), $endOfMonth->toDateString()])
            ->pluck('id');

        $csRev = (float) CounterSaleSparePart::whereIn('countersale_id', $thisMonthCsIds)->sum('final_amount');

        $this->revenueSplitLabels = ['Job Cards (Parts & Labour)', 'Counter Sales (POS)'];
        $this->revenueSplitSeries = [
            round($jcRev),
            round($csRev),
        ];

        // 7. Active Vehicles In Bays (Latest 7)
        $activeList = JobCard::with(['customer', 'vehicle'])
            ->where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->whereIn('status', [0, 4, 1])
            ->orderBy('id', 'desc')
            ->take(7)
            ->get();

        if ($activeList->isEmpty()) {
            $activeList = JobCard::with(['customer', 'vehicle'])
                ->where('user_id', $ownerId)
                ->where('soft_delete', 0)
                ->orderBy('id', 'desc')
                ->take(7)
                ->get();
        }

        $this->activeJobCards = $activeList;

        // 8. Upcoming Appointments
        $this->upcomingAppointments = Appointment::where('workshop_id', $ownerId)
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->take(5)
            ->get();

        // 9. Low Stock Items (Threshold <= 5)
        $this->lowStockItems = ProductStock::where('user_id', $ownerId)
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();
    }

    /**
     * Compute actual realized revenue (matching Profit & Loss Report formula)
     * Parts + Labour + Lubes + Accessory + Tools + Outsource from Completed (2) and Closed (3) JobCards + Counter Sales
     */
    private function calculateFinancialRevenue($ownerId, $startDate, $endDate): float
    {
        // 1. ONLY Completed (status=2) and Closed (status=3) JobCards
        $jobcardIds = JobCard::where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->whereIn('status', [2, 3])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->pluck('id')
            ->toArray();

        // 2. Extra charges (Labour & Outsource)
        $extraChargesTotal = (float) JobCardExtraCharge::whereIn('jobcard_id', $jobcardIds)
            ->sum(DB::raw('COALESCE(amount, charges, 0)'));

        // 3. Spare parts used in JobCards
        $jobcardPartsTotal = (float) JobCardSparePart::whereIn('jobcard_id', $jobcardIds)
            ->sum('final_amount');

        // 4. Counter Sales parts sold
        $counterSaleIds = CounterSale::where('workshop_id', $ownerId)
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate->toDateString(), $endDate->toDateString()])
            ->pluck('id')
            ->toArray();

        $counterPartsTotal = 0;
        if (!empty($counterSaleIds)) {
            $counterPartsTotal = (float) CounterSaleSparePart::whereIn('countersale_id', $counterSaleIds)
                ->sum('final_amount');
        }

        return $extraChargesTotal + $jobcardPartsTotal + $counterPartsTotal;
    }

    public function render()
    {
        return view('livewire.workshop.dashboard', [
            'message' => $this->message,
            'monthlyRevenue' => $this->monthlyRevenue,
            'inProcessEstimatedRevenue' => $this->inProcessEstimatedRevenue,
            'revenueGrowthPercent' => $this->revenueGrowthPercent,
            'activeJobsCount' => $this->activeJobsCount,
            'openJobsCount' => $this->openJobsCount,
            'processJobsCount' => $this->processJobsCount,
            'confirmedJobsCount' => $this->confirmedJobsCount,
            'completedThisMonth' => $this->completedThisMonth,
            'totalJobCards' => $this->totalJobCards,
            'upcomingAppointmentsCount' => $this->upcomingAppointmentsCount,
            'lowStockCount' => $this->lowStockCount,
            'trendMonths' => $this->trendMonths,
            'trendRevenues' => $this->trendRevenues,
            'trendJobs' => $this->trendJobs,
            'statusLabels' => $this->statusLabels,
            'statusSeries' => $this->statusSeries,
            'activeJobCards' => $this->activeJobCards,
            'upcomingAppointments' => $this->upcomingAppointments,
            'lowStockItems' => $this->lowStockItems,
        ]);
    }
}
