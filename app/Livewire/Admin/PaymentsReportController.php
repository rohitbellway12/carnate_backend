<?php

namespace App\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class PaymentsReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public string $search = '';
    public int $perPage = 10;

    // Filters
    public ?string $filterType = null; // daily, weekly, monthly
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public string $statusFilter = ''; // success, failed

    public ?int $viewPaymentId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilterType(): void { $this->resetPage(); }
    public function updatingFromDate(): void { $this->resetPage(); }
    public function updatingToDate(): void { $this->resetPage(); }
    public function updatingStatusFilter(): void { $this->resetPage(); }

    public function viewPayment(int $paymentId): void
    {
        $this->viewPaymentId = $paymentId;
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

        return Payment::query()
            ->with(['user', 'order.orderItem.SpareParts'])
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('payment_id', 'LIKE', "%$s%")
                        ->orWhere('order_id', 'LIKE', "%$s%")
                        ->orWhere('amount', 'LIKE', "%$s%")
                        ->orWhereHas('user', function ($uQ) use ($s) {
                            $uQ->where('company_name', 'LIKE', "%$s%")
                               ->orWhereRaw("CONCAT(name,' ',lastname) LIKE ?", ["%$s%"]);
                        });
                });
            })
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            })
            ->when($this->statusFilter !== '', function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy('created_at', 'desc');
    }

    public function downloadExcel()
    {
        $query = $this->getBaseQuery();
        $payments = $query->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=payments-report.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, ['#', 'Payment ID (Txn)', 'Order ID', 'Workshop Vendor', 'Company Name', 'Payment Date', 'Amount (₹)', 'Status']);

            foreach ($payments as $index => $p) {
                fputcsv($file, [
                    $index + 1,
                    $p->payment_id,
                    '#' . $p->order_id,
                    $p->user ? $p->user->name.' '.$p->user->lastname : 'N/A',
                    $p->user->company_name ?? 'N/A',
                    $p->created_at ? \Carbon\Carbon::parse($p->created_at)->format('d M Y, h:i A') : 'N/A',
                    (float)$p->amount,
                    ucfirst($p->status)
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'payments-report.csv', $headers);
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $payments = $query->get();

        // Calculate Totals
        $totals = [
            'total' => $payments->count(),
            'success' => $payments->where('status', 'success')->count(),
            'failed' => $payments->where('status', 'failed')->count(),
            'total_amount' => $payments->where('status', 'success')->sum('amount'),
            'failed_amount' => $payments->where('status', 'failed')->sum('amount'),
        ];

        $pdf = Pdf::loadView('livewire.admin.pdf.payments-report', [
            'payments' => $payments,
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
            'payments-report.pdf'
        );
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $payments = (clone $query)->paginate($this->perPage);

        // Stats calculation
        $allPayments = (clone $query)->get();
        $totals = [
            'total' => $allPayments->count(),
            'success' => $allPayments->where('status', 'success')->count(),
            'failed' => $allPayments->where('status', 'failed')->count(),
            'total_amount' => $allPayments->where('status', 'success')->sum('amount'),
            'failed_amount' => $allPayments->where('status', 'failed')->sum('amount'),
        ];

        $detail = null;
        if ($this->viewPaymentId) {
            $detail = Payment::with(['user', 'order.orderItem.SpareParts'])->find($this->viewPaymentId);
        }

        return view('livewire.admin.payments-report', [
            'payments' => $payments,
            'totals' => $totals,
            'detail' => $detail,
        ]);
    }
}
