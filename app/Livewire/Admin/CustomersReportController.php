<?php

namespace App\Livewire\Admin;

use App\Models\Customer;
use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class CustomersReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null;
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $vehicleFilter = ''; // with, without, all

    public ?int $viewCustomerId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingVehicleFilter(): void { $this->resetPage(); }

    public function viewCustomer(int $customerId): void
    {
        $this->viewCustomerId = $customerId;
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

        return Customer::query()
            ->with(['user', 'vehicles'])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->whereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"])
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
            ->when($this->vehicleFilter !== '', function ($q) {
                if ($this->vehicleFilter === 'with') {
                    $q->has('vehicles');
                } elseif ($this->vehicleFilter === 'without') {
                    $q->doesntHave('vehicles');
                }
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $customers = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=customers-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Customer Name', 'Email', 'Mobile', 'Registered By', 'Vehicles Count', 'Join Date']);

            foreach ($customers as $index => $c) {
                $registeredBy = 'Admin Registered';
                if ($c->user) {
                    $registeredBy = $c->user->company_name ?? ($c->user->name . ' ' . $c->user->lastname);
                }

                fputcsv($file, [
                    $index + 1,
                    $c->name . ' ' . $c->lastname,
                    $c->email ?? '-',
                    $c->mobile_no ?? '-',
                    $registeredBy,
                    $c->vehicles->count(),
                    \Carbon\Carbon::parse($c->created_at)->format('d M Y')
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'customers-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $customers = $query->get();

        // Calculate stats
        $allMatchedIds = $customers->pluck('id');
        $totalCustomers = $allMatchedIds->count();
        $totalVehicles = Vehicle::whereIn('customer_id', $allMatchedIds)->count();
        $withVehicle = Customer::whereIn('id', $allMatchedIds)->has('vehicles')->count();
        $withoutVehicle = $totalCustomers - $withVehicle;

        $totals = [
            'total_customers' => $totalCustomers,
            'with_vehicle' => $withVehicle,
            'without_vehicle' => max($withoutVehicle, 0),
            'total_vehicles' => $totalVehicles,
        ];

        $pdf = Pdf::loadView('livewire.admin.pdf.customers-report', [
            'customers' => $customers,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'customers-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $customers = (clone $query)->paginate($this->perPage);

        // Stats calculation
        $allMatchedIds = (clone $query)->pluck('id');
        $totalCustomers = $allMatchedIds->count();
        $totalVehicles = Vehicle::whereIn('customer_id', $allMatchedIds)->count();
        $withVehicle = Customer::whereIn('id', $allMatchedIds)->has('vehicles')->count();
        $withoutVehicle = $totalCustomers - $withVehicle;

        $totals = [
            'total_customers' => $totalCustomers,
            'with_vehicle' => $withVehicle,
            'without_vehicle' => max($withoutVehicle, 0),
            'total_vehicles' => $totalVehicles,
        ];

        $detail = null;
        if ($this->viewCustomerId) {
            $detail = Customer::with(['vehicles.brand', 'vehicles.vehicletype', 'user'])->find($this->viewCustomerId);
        }

        return view('livewire.admin.customers-report', [
            'customers' => $customers,
            'totals' => $totals,
            'detail' => $detail,
        ]);
    }
}
