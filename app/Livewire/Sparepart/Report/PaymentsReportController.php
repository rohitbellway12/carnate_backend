<?php

namespace App\Livewire\Sparepart\Report;

use App\Models\Wallet;
use App\Models\SparePartVendor;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.spare-part-app')]
class PaymentsReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null;
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $typeFilter = ''; // type: 0 (Earning), 1 (Withdrawal)

    public ?int $viewOrderId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingTypeFilter(): void { $this->resetPage(); }

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

        return Wallet::query()
            ->with(['order'])
            ->where('user_id', $vendorId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('order_id', 'LIKE', "%$s%")
                        ->orWhere('amount', 'LIKE', "%$s%")
                        ->orWhereHas('order', function ($oQ) use ($s) {
                            $oQ->where('invoice_number', 'LIKE', "%$s%")
                                ->orWhere('id', 'LIKE', "%$s%");
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$startDate, $endDate]);
            })
            ->when($this->typeFilter !== '', function ($q) {
                $q->where('type', $this->typeFilter);
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $transactions = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=wallet-payments-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Transaction Date', 'Invoice No.', 'Description', 'Type', 'Amount (₹)', 'Running Wallet Total (₹)']);

            foreach ($transactions as $index => $t) {
                $type = $t->type == 0 ? 'Earning / Deposit' : 'Withdrawal';
                $invoiceNo = $t->order ? sparepartOrderReference($t->order) : '-';
                $description = $t->order_id > 0 
                    ? 'Earning from order ' . $invoiceNo
                    : ($t->type == 1 ? "Withdrawal payout request" : "Wallet Adjustment");

                fputcsv($file, [
                    $index + 1,
                    $t->created_at ? \Carbon\Carbon::parse($t->created_at)->format('d M Y, h:i A') : 'N/A',
                    $invoiceNo,
                    $description,
                    $type,
                    (float)$t->amount,
                    (float)$t->total
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'wallet-payments-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $transactions = $query->get();
        $vendorId = Auth::guard('sparepart')->user()->id;
        $vendor = SparePartVendor::find($vendorId);

        $totals = [
            'balance' => (float)($vendor->wallet ?? 0),
            'earnings' => (float)$transactions->where('type', 0)->sum('amount'),
            'withdrawals' => (float)$transactions->where('type', 1)->sum('amount'),
            'count' => $transactions->count()
        ];

        $pdf = Pdf::loadView('livewire.sparepart.report.pdf.payments-report', [
            'transactions' => $transactions,
            'totals' => $totals,
            'filterType' => $this->filterType,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'typeFilter' => $this->typeFilter,
            'search' => $this->search,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return response()->streamDownload(
            fn() => print($pdf->output()),
            'wallet-payments-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $transactions = $query->paginate($this->perPage);

        $vendorId = Auth::guard('sparepart')->user()->id;
        $vendor = SparePartVendor::find($vendorId);

        // Stats summary
        $allTx = $this->getBaseQuery()->get();
        $totals = [
            'balance' => (float)($vendor->wallet ?? 0),
            'earnings' => (float)$allTx->where('type', 0)->sum('amount'),
            'withdrawals' => (float)$allTx->where('type', 1)->sum('amount'),
            'count' => $allTx->count()
        ];

        $selectedOrder = null;
        if ($this->viewOrderId) {
            $selectedOrder = Order::with(['orderItem' => function ($qry) use ($vendorId) {
                $qry->where('user_id', $vendorId)->with('SpareParts');
            }])->find($this->viewOrderId);
        }

        return view('livewire.sparepart.report.payments-report', compact('transactions', 'totals', 'selectedOrder', 'vendorId'));
    }
}
