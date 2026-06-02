<?php

namespace App\Livewire\Workshop;

use App\Models\JobCard;
use App\Models\WorkShopVendor;
use App\Models\ProductStock;
use App\Models\WorkshopSupplier;
use App\Models\LabourCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class JobCardReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public int $activeJobs = 0;
    public int $totalJobs = 0;
    public array $statusCounts = [];
    // Stocks metrics
    public int $stockTotal = 0;
    public int $stockTotalQty = 0;
    public array $stockByCategory = [];
    public string $activeTab = 'jobs';
    public bool $jobsTableOpen = false;
    public bool $stocksTableOpen = false;
    // Suppliers & Labour
    public int $supplierCount = 0;
    public int $labourCount = 0;
    public float $labourTotal = 0;
    public array $topStaff = [];
    public array $staffJobs = [];
    public string $selectedStaffName = '';

    public function setTab(string $tab): void
    {
        $this->activeTab = in_array($tab, ['jobs','stocks','staff']) ? $tab : 'jobs';
    }

    public function toggleJobsTable(): void
    {
        $this->jobsTableOpen = !$this->jobsTableOpen;
    }

    public function toggleStocksTable(): void
    {
        $this->stocksTableOpen = !$this->stocksTableOpen;
    }

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->refreshMetrics();
    }

    public function refreshMetrics(): void
    {
        $user = WorkShopVendor::find($this->workshopId);
        $ownerId = $user && $user->is_user == 0 ? $this->workshopId : ($user->parent_id ?? $this->workshopId);
        //dd($ownerId);
          $baseQuery = JobCard::where('user_id', $ownerId)->where('soft_delete', 0);


        $this->totalJobs = (clone $baseQuery)->count();

        // Assuming status column integers: 0..n and active are non-completed (<4) – align with existing filtering
        $this->activeJobs = (clone $baseQuery)->whereIn('status', [0,1,2,3])->count();

        $statuses = [
            0 => 'Open',
            1 => 'Confirmed',
            2 => 'Completed',
            3 => 'Close',
        ];

        $counts = [];
        foreach ($statuses as $code => $label) {
            $counts[] = [
                'code' => $code,
                'label' => $label,
                'count' => (clone $baseQuery)->where('status', $code)->count(),
            ];
        }
        $this->statusCounts = $counts;

        // Stocks
        try {
            $baseStock = ProductStock::where('user_id', $ownerId);
            $this->stockTotal = (clone $baseStock)->count();
            $this->stockTotalQty = (int) (clone $baseStock)->sum('stock');

            $cats = [
                1 => 'Accessory',
                2 => 'Parts',
                4 => 'Lubricant',
                3 => 'Tools',
            ];



            $byCat = [];
            foreach ($cats as $id => $label) {
                $q = (clone $baseStock)->where('category_id', $id);
                $byCat[$id] = [
                    'label' => $label,
                    'count' => (clone $q)->count(),
                    'qty' => (int) (clone $q)->sum('stock'),
                ];
            }
            //dd($byCat);
            $this->stockByCategory = $byCat;
        } catch (\Throwable $e) {
            $this->stockTotal = 0;
            $this->stockTotalQty = 0;
            $this->stockByCategory = [];
        }

        // Suppliers
        try {
            $this->supplierCount = WorkshopSupplier::where('user_id', $ownerId)->count();
        } catch (\Throwable $e) {
            $this->supplierCount = 0;
        }

        // Labour
        try {
            $labourBase = LabourCharge::where('user_id', $ownerId);
            $this->labourCount = (clone $labourBase)->count();
            $this->labourTotal = (float) (clone $labourBase)->sum('total');
        } catch (\Throwable $e) {
            $this->labourCount = 0;
            $this->labourTotal = 0.0;
        }

        // Top staff by completed jobcards (ensure top 3, show 0 if fewer mechanics)
        try {
            $completedStatuses = [2]; // Completed; add 3 for Closed if needed

            // Base mechanics list for this workshop (mechanics/staff under this owner)
            $mechanics = DB::table('work_shop_vendor')
                ->where('parent_id', $ownerId)
                ->where(function($q){
                    $q->where('user_type', 32)->orWhere('type', 1);
                })
                ->select('id','name','lastname')
                ->get();

            // Counts of completed jobcards per mechanic
            $counts = DB::table('job_card_extra_charges as jec')
                ->join('job_cards as jc', 'jc.id', '=', 'jec.jobcard_id')
                ->where('jc.user_id', $ownerId)
                ->where('jc.soft_delete', 0)
                ->whereIn('jc.status', $completedStatuses)
                ->whereNotNull('jec.machanic_id')
                ->groupBy('jec.machanic_id')
                ->selectRaw('jec.machanic_id as staff_id, COUNT(DISTINCT jc.id) as completed_jobs')
                ->pluck('completed_jobs','staff_id');

            $merged = $mechanics->map(function($m) use ($counts){
                $fullName = trim(($m->name ?? '').' '.($m->lastname ?? ''));
                return [
                    'id' => (int) $m->id,
                    'name' => $fullName !== '' ? $fullName : 'Unknown',
                    'count' => (int) ($counts[$m->id] ?? 0),
                ];
            })->sortByDesc('count')->values()->all();

            // Take top 3; if fewer than 3, pad with placeholders
            $top = array_slice($merged, 0, 3);
            while (count($top) < 3) {
                $top[] = [ 'id' => 0, 'name' => '—', 'count' => 0 ];
            }
            $this->topStaff = $top;
        } catch (\Throwable $e) {
            $this->topStaff = [
                [ 'id' => 0, 'name' => '—', 'count' => 0 ],
                [ 'id' => 0, 'name' => '—', 'count' => 0 ],
                [ 'id' => 0, 'name' => '—', 'count' => 0 ],
            ];
        }
    }

    public function render()
    {
        $user = WorkShopVendor::find($this->workshopId);
        $ownerId = $user && $user->is_user == 0 ? $this->workshopId : ($user->parent_id ?? $this->workshopId);

        $jobs = JobCard::where('user_id', $ownerId)
            ->where('soft_delete', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.workshop.job-card-report', compact('jobs'));
    }

    public function viewStaffJobs(int $staffId): void
    {
        $user = WorkShopVendor::find($this->workshopId);
        $ownerId = $user && $user->is_user == 0 ? $this->workshopId : ($user->parent_id ?? $this->workshopId);

        $staff = DB::table('work_shop_vendor')->select('name','lastname')->where('id', $staffId)->first();
        $this->selectedStaffName = $staff ? trim(($staff->name ?? '').' '.($staff->lastname ?? '')) : 'Staff';

        $completedStatuses = [2]; // add 3 for Closed if needed

        $rows = DB::table('job_card_extra_charges as jec')
            ->join('job_cards as jc', 'jc.id', '=', 'jec.jobcard_id')
            ->leftJoin('customers as c', 'c.id', '=', 'jc.customer_id')
            ->where('jc.user_id', $ownerId)
            ->where('jc.soft_delete', 0)
            ->whereIn('jc.status', $completedStatuses)
            ->where('jec.machanic_id', $staffId)
            ->select('jc.id','jc.jobcard_number','c.company_name','c.name as cust_name','c.lastname as cust_lastname','c.mobile_no')
            ->orderByDesc('jc.created_at')
            ->limit(25)
            ->get();

        $this->staffJobs = $rows->map(function($r){
            return [
                'id' => (int) $r->id,
                'number' => $r->jobcard_number ?? '-',
                'customer' => ($r->company_name ?: trim((($r->cust_name ?? '').' '.($r->cust_lastname ?? '')))) ?: '-',
                'phone' => $r->mobile_no ?? '-',
            ];
        })->toArray();

        $this->dispatch('bs:openmodal', modal: 'staffJobsModal');
    }
}


