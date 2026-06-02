<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class OrdersReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $statusFilter = ''; // order_status: 0,1,2,3,4
    public string $paymentStatusFilter = ''; // payment_status: 0,1,2

    public ?int $viewOrderId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }
    public function updatingPaymentStatusFilter(): void { $this->resetPage(); }

    public function viewOrder(int $orderId): void
    {
        $this->viewOrderId = $orderId;
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

        return Order::query()
            ->with(['orderItem.SpareParts.Image', 'orderItem.sparePartVendor', 'workShopVendor', 'sparePartVendor'])
            ->where('is_confim', 1)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('id', 'LIKE', "%$s%")
                        ->orWhereHas('workShopVendor', function ($wQ) use ($s) {
                            $wQ->where('company_name', 'LIKE', "%$s%")
                               ->orWhereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"]);
                        })
                        ->orWhereHas('orderItem.SpareParts', function ($pQ) use ($s) {
                            $pQ->where('name', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$startDate, $endDate]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                $q->where('order_status', $this->statusFilter);
            })
            ->when($this->paymentStatusFilter !== '', function ($q) {
                $q->where('payment_status', $this->paymentStatusFilter);
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $orders = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Order No.', 'Items', 'Workshop', 'Order Date', 'Amount (₹)', 'Qty / Item', 'Payment Status', 'Order Status']);

            foreach ($orders as $index => $o) {
                $orderItemsString = implode(', ', $o->orderItem->pluck('SpareParts.name')->filter()->toArray());

                $paymentStatus = match ($o->payment_status) {
                    1 => 'Paid',
                    2 => 'Partially Paid',
                    default => 'Pending',
                };

                $orderStatus = match ($o->order_status) {
                    1 => ($o->payment_status == 0 ? 'Awaiting Payment' : 'Accepted'),
                    2 => 'Declined',
                    3 => 'Handover',
                    4 => 'Received',
                    default => 'Pending',
                };

                fputcsv($file, [
                    $index + 1,
                    '#' . $o->id,
                    $orderItemsString ?: 'N/A',
                    $o->workShopVendor->company_name ?? ($o->workShopVendor ? $o->workShopVendor->name.' '.$o->workShopVendor->lastname : 'N/A'),
                    $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A',
                    (float)$o->total_amount,
                    $o->total_quantity . ' (' . $o->total_item . ')',
                    $paymentStatus,
                    $orderStatus
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'orders-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $orders = $query->get();

        // Calculate Totals
        $totals = [
            'total' => $orders->count(),
            'pending' => $orders->where('order_status', 0)->count(),
            'accepted' => $orders->where('order_status', 1)->count(),
            'handover' => $orders->where('order_status', 3)->count(),
            'received' => $orders->where('order_status', 4)->count(),
            'declined' => $orders->where('order_status', 2)->count(),
            'total_amount' => $orders->sum('total_amount'),
            'paid_amount' => $orders->where('payment_status', 1)->sum('total_amount') + ($orders->where('payment_status', 2)->sum('total_amount') * 0.5), // Estimate partial as 50% for high-level stat
        ];

        $pdf = Pdf::loadView('livewire.admin.pdf.orders-report', [
            'orders' => $orders,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'statusFilter' => $this->statusFilter,
            'paymentStatusFilter' => $this->paymentStatusFilter,
            'search' => $this->search,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'orders-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $orders = (clone $query)->paginate($this->perPage);

        // Stats calculation
        $allOrders = (clone $query)->get();
        $totals = [
            'total' => $allOrders->count(),
            'pending' => $allOrders->where('order_status', 0)->count(),
            'accepted' => $allOrders->where('order_status', 1)->count(),
            'handover' => $allOrders->where('order_status', 3)->count(),
            'received' => $allOrders->where('order_status', 4)->count(),
            'declined' => $allOrders->where('order_status', 2)->count(),
            'total_amount' => $allOrders->sum('total_amount'),
            'paid_amount' => $allOrders->where('payment_status', 1)->sum('total_amount'),
        ];

        $detail = null;
        if ($this->viewOrderId) {
            $detail = Order::with(['orderItem.SpareParts.Image', 'orderItem.sparePartVendor', 'workShopVendor'])->find($this->viewOrderId);
        }

        return view('livewire.admin.orders-report', [
            'orders' => $orders,
            'totals' => $totals,
            'detail' => $detail,
        ]);
    }
}
