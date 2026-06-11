<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SparePartVendor;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
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
    public string $statusFilter = ''; // item status: 0,1,2,3,4,5
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
        $vendorId = Auth::guard('sparepart')->user()->id;

        return Order::query()
            ->with(['orderItem' => function ($qry) use ($vendorId) {
                $qry->where('user_id', $vendorId)->with('SpareParts');
            }])
            ->where('is_confim', 1)
            ->whereHas('orderItem', function ($qry) use ($vendorId) {
                $qry->where('user_id', $vendorId);
            })
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('id', 'LIKE', "%$s%")
                        ->orWhere('invoice_number', 'LIKE', "%$s%")
                        ->orWhereHas('orderItem.SpareParts', function ($pQ) use ($s) {
                            $pQ->where('name', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$startDate, $endDate]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                $vendorId = Auth::guard('sparepart')->user()->id;
                $q->whereHas('orderItem', function ($sub) use ($vendorId) {
                    $sub->where('user_id', $vendorId)->where('status', $this->statusFilter);
                });
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
        $vendorId = Auth::guard('sparepart')->user()->id;

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=sparepart-orders-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $vendor = SparePartVendor::find($vendorId);

        $callback = function() use ($orders, $vendorId, $vendor) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Order No.', 'Invoice No.', 'Items', 'Order Date', 'My Items Total (₹)', 'Payment Status', 'Order Status']);

            foreach ($orders as $index => $o) {
                $myItems = $o->orderItem->where('user_id', $vendorId);
                $orderItemsString = implode(', ', $myItems->pluck('SpareParts.name')->filter()->toArray());

                $totalAmount = (float) $myItems->sum('total_amount');

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
                    sparepartOrderReference($o, $vendor),
                    $orderItemsString ?: 'N/A',
                    $o->order_date ? \Carbon\Carbon::parse($o->order_date)->format('d M Y, h:i A') : 'N/A',
                    $totalAmount,
                    $paymentStatus,
                    $orderStatus
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'sparepart-orders-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $orders = $query->get();
        $vendorId = Auth::guard('sparepart')->user()->id;

        // Calculate Totals for this vendor
        $totals = [
            'total' => $orders->count(),
            'pending' => 0,
            'accepted' => 0,
            'declined' => 0,
            'handover' => 0,
            'received' => 0,
            'delayed' => 0,
            'total_amount' => 0.0,
            'earned_amount' => 0.0,
        ];

        foreach ($orders as $o) {
            $myItems = $o->orderItem->where('user_id', $vendorId);
            $totals['total_amount'] += (float) $myItems->sum('total_amount');
            
            foreach ($myItems as $item) {
                switch ($item->status) {
                    case 0: $totals['pending']++; break;
                    case 1: $totals['accepted']++; break;
                    case 2: $totals['declined']++; break;
                    case 3: 
                        $totals['handover']++; 
                        $totals['earned_amount'] += (float) $item->total_amount;
                        break;
                    case 4: 
                        $totals['received']++; 
                        $totals['earned_amount'] += (float) $item->total_amount;
                        break;
                    case 5: $totals['delayed']++; break;
                }
            }
        }

        $vendor = SparePartVendor::find($vendorId);

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.orders-report', [
            'orders' => $orders,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'statusFilter' => $this->statusFilter,
            'paymentStatusFilter' => $this->paymentStatusFilter,
            'search' => $this->search,
            'vendorId' => $vendorId,
            'vendor' => $vendor,
        ])->setPaper('a4', 'landscape');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'sparepart-orders-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $orders = $query->paginate($this->perPage);
        $vendorId = Auth::guard('sparepart')->user()->id;

        // Calculate statistics cards for this vendor
        $allOrders = $this->getBaseQuery()->get();
        $totals = [
            'total' => $allOrders->count(),
            'pending' => 0,
            'accepted' => 0,
            'declined' => 0,
            'handover' => 0,
            'received' => 0,
            'delayed' => 0,
            'total_amount' => 0.0,
            'earned_amount' => 0.0,
        ];

        foreach ($allOrders as $o) {
            $myItems = $o->orderItem->where('user_id', $vendorId);
            $totals['total_amount'] += (float) $myItems->sum('total_amount');
            
            foreach ($myItems as $item) {
                switch ($item->status) {
                    case 0: $totals['pending']++; break;
                    case 1: $totals['accepted']++; break;
                    case 2: $totals['declined']++; break;
                    case 3: 
                        $totals['handover']++; 
                        $totals['earned_amount'] += (float) $item->total_amount;
                        break;
                    case 4: 
                        $totals['received']++; 
                        $totals['earned_amount'] += (float) $item->total_amount;
                        break;
                    case 5: $totals['delayed']++; break;
                }
            }
        }

        $selectedOrder = null;
        if ($this->viewOrderId) {
            $selectedOrder = Order::with(['orderItem' => function ($qry) use ($vendorId) {
                $qry->where('user_id', $vendorId)->with('SpareParts');
            }])->find($this->viewOrderId);
        }

        $vendor = SparePartVendor::find($vendorId);

        return view('livewire.sparepart.report.orders-report', compact('orders', 'totals', 'selectedOrder', 'vendorId', 'vendor'));
    }
}
