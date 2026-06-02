<?php

namespace App\Livewire\Workshop;

use App\Models\Customer;
use App\Models\WorkShopVendor;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


#[Layout('components.layouts.workshop-app')]
class CustomersReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;

    // 🧩 New filter properties
    public ?string $filterType = null; // daily, weekly, monthly, custom
    public ?string $fromDate = null;
    public ?string $toDate = null;

    public ?int $viewCustomerId = null;

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }

    public function viewCustomer(int $customerId): void
    {
        $this->viewCustomerId = $customerId;
        $this->dispatch('show-customer-modal');
    }

    //  Helper for date range
    private function getDateRange(): array
    {
        $today = now();

        // if custom date range manually entered
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

    public function render()
    {
        [$startDate, $endDate] = $this->getDateRange();

        $baseQuery = Customer::query()
            ->where('user_id', $this->workshopId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
                  ->orWhere('email', 'LIKE', "%$s%")
                  ->orWhere('mobile_no', 'LIKE', "%$s%");
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->orderBy('created_at', 'desc');

        $customers = (clone $baseQuery)->paginate($this->perPage);

        $detail = null;
        if ($this->viewCustomerId) {
            $detail = Customer::with(['vehicles.brand', 'vehicles.vehicletype'])
                ->where('user_id', $this->workshopId)
                ->find($this->viewCustomerId);
        }

        // Totals (respect filters)
        $allMatchedIds = (clone $baseQuery)->pluck('id');
        $totalCustomers = $allMatchedIds->count();
        $withVehicle = 0;
        $withoutVehicle = 0;
        $totalVehicles = 0;
        if ($totalCustomers > 0) {
            $vehicleCounts = Vehicle::whereIn('customer_id', $allMatchedIds)
                ->selectRaw('customer_id, COUNT(*) as cnt')
                ->groupBy('customer_id')
                ->pluck('cnt', 'customer_id');
            $totalVehicles = (int) $vehicleCounts->sum();
            $withVehicle = $vehicleCounts->count();
            $withoutVehicle = $totalCustomers - $withVehicle;
        }

        $totals = [
            'total_customers' => $totalCustomers,
            'with_vehicle' => $withVehicle,
            'without_vehicle' => max($withoutVehicle, 0),
            'total_vehicles' => $totalVehicles,
        ];

        return view('livewire.workshop.customers-report', [
            'customers' => $customers,
            'detail' => $detail,
            'totals' => $totals,
        ]);
    }



    // public function downloadPDF()
    // {
    //     [$startDate, $endDate] = $this->getDateRange();

    //     // Apply same filters used in render()
    //     $query = Customer::query()
    //         ->where('user_id', $this->workshopId)
    //         ->when(trim($this->search) !== '', function ($q) {
    //             $s = trim($this->search);
    //             $q->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
    //             ->orWhere('email', 'LIKE', "%$s%")
    //             ->orWhere('mobile_no', 'LIKE', "%$s%");
    //         })
    //         ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
    //             $q->whereBetween('created_at', [
    //                 Carbon::parse($startDate)->startOfDay(),
    //                 Carbon::parse($endDate)->endOfDay()
    //             ]);
    //         })
    //         ->orderBy('created_at', 'desc');



    //     $customers = $query->get();

    //     // 🧮 Totals same as UI
    //     $allMatchedIds = $customers->pluck('id');
    //     $totalCustomers = $allMatchedIds->count();
    //     $vehicleCounts = Vehicle::whereIn('customer_id', $allMatchedIds)
    //         ->selectRaw('customer_id, COUNT(*) as cnt')
    //         ->groupBy('customer_id')
    //         ->pluck('cnt', 'customer_id');
    //     $totalVehicles = (int) $vehicleCounts->sum();
    //     $withVehicle = $vehicleCounts->count();
    //     $withoutVehicle = $totalCustomers - $withVehicle;

    //     $totals = [
    //         'total_customers' => $totalCustomers,
    //         'with_vehicle' => $withVehicle,
    //         'without_vehicle' => max($withoutVehicle, 0),
    //         'total_vehicles' => $totalVehicles,
    //     ];

    //     // 🧾 Generate PDF
    //     $pdf = Pdf::loadView('livewire.workshop.pdf.customers-report', [
    //         'customers' => $customers,
    //         'totals' => $totals,
    //         'filterType' => $this->filterType,
    //         'fromDate' => $this->fromDate,
    //         'toDate' => $this->toDate,
    //         'search' => $this->search,
    //     ])->setPaper('a4', 'portrait');

    //     return response()->streamDownload(
    //         fn() => print($pdf->output()),
    //         'customers-report.pdf'
    //     );
    // }

    public function downloadPDF()
    {
        [$startDate, $endDate] = $this->getDateRange();

        // 🧾 Base query (same as render)
        $baseQuery = Customer::query()
            ->where('user_id', $this->workshopId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
                  ->orWhere('email', 'LIKE', "%$s%")
                  ->orWhere('mobile_no', 'LIKE', "%$s%");
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->orderBy('created_at', 'desc');

        //  Include vehicle relations (brand + type)
        $customers = (clone $baseQuery)
            ->with(['vehicles.brand', 'vehicles.vehicletype'])
            ->get();

        // 📊 Totals (same logic as render)
        $allMatchedIds = (clone $baseQuery)->pluck('id');
        $totalCustomers = $allMatchedIds->count();
        $withVehicle = 0;
        $withoutVehicle = 0;
        $totalVehicles = 0;

        if ($totalCustomers > 0) {
            $vehicleCounts = Vehicle::whereIn('customer_id', $allMatchedIds)
                ->selectRaw('customer_id, COUNT(*) as cnt')
                ->groupBy('customer_id')
                ->pluck('cnt', 'customer_id');

            $totalVehicles = (int) $vehicleCounts->sum();
            $withVehicle = $vehicleCounts->count();
            $withoutVehicle = $totalCustomers - $withVehicle;
        }

        $totals = [
            'total_customers' => $totalCustomers,
            'with_vehicle' => $withVehicle,
            'without_vehicle' => max($withoutVehicle, 0),
            'total_vehicles' => $totalVehicles,
        ];

        // Generate PDF
        $pdf = Pdf::loadView('livewire.workshop.pdf.customers-report', [
            'customers' => $customers,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
        ])->setPaper('a4', 'portrait');

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'customers-report.pdf'
        );
    }


}
