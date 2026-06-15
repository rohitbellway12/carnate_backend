<?php

namespace App\Livewire\Workshop;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

#[Layout('components.layouts.workshop-app')]
class ExpensesReportController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public int $workshopId;
    public string $search = '';
    public int $perPage = 10;
    public ?int $viewExpenseId = null;

    // 🔹 Filters
    public ?string $fromDate = null;
    public ?string $toDate = null;
    public ?string $filterType = null; // daily, weekly, monthly

    public function mount(): void
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function updatingSearch(): void { $this->resetPage(); }

    public function updatedFilterType(): void
    {
        // Auto-set date range based on selected type
        if ($this->filterType === 'daily') {
            $this->fromDate = Carbon::today()->toDateString();
            $this->toDate = Carbon::today()->toDateString();
        } elseif ($this->filterType === 'weekly') {
            $this->fromDate = Carbon::now()->startOfWeek()->toDateString();
            $this->toDate = Carbon::now()->endOfWeek()->toDateString();
        } elseif ($this->filterType === 'monthly') {
            $this->fromDate = Carbon::now()->startOfMonth()->toDateString();
            $this->toDate = Carbon::now()->endOfMonth()->toDateString();
        } else {
            $this->fromDate = null;
            $this->toDate = null;
        }
    }

    public function viewExpense(int $expenseId): void
    {
        $this->viewExpenseId = $expenseId;
    }

    public function downloadPDF()
    {
        $query = $this->getBaseQuery();
        $expenses = $query->get();

        $pdf = Pdf::loadView('livewire.workshop.pdf.expenses-report', [
            'expenses' => $expenses,
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'search' => $this->search,
        ])->setPaper('a4', 'portrait');

        $pdf->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Expenses_Report.pdf');
    }

    protected function getBaseQuery()
    {
        return Expense::with(['workshopCategory', 'workshopSupplier'])
            ->where('parent_id', $this->workshopId)
            ->when(trim($this->search) !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($sub) use ($s) {
                    $sub->where('bill_number', 'LIKE', "%$s%")
                        ->orWhere('description', 'LIKE', "%$s%")
                        ->orWhereHas('workshopSupplier', fn($qs) => $qs->where('business_first_name', 'LIKE', "%$s%"))
                        ->orWhereHas('workshopCategory', fn($qc) => $qc->where('title', 'LIKE', "%$s%"));
                });
            })
            ->when($this->fromDate && $this->toDate, fn($q) =>
                $q->whereBetween(DB::raw('DATE(date)'), [$this->fromDate, $this->toDate])
            )
            ->orderBy('created_at', 'desc');
    }

    public function render()
    {
        $query = $this->getBaseQuery();
        $items = (clone $query)->paginate($this->perPage);

        // Totals
        $all = (clone $query);
        $totals = [
            'count' => $all->count(),
            'total' => round((float)$all->sum('total_amount'), 2),
            'paid' => round((float)$all->sum('paid_amount'), 2),
            'balance' => round((float)$all->sum('balance_amount'), 2),
        ];

        $detail = null;
        if ($this->viewExpenseId) {
            $detail = Expense::with(['workshopCategory', 'workshopSupplier'])
                ->where('parent_id', $this->workshopId)
                ->find($this->viewExpenseId);
        }

        return view('livewire.workshop.expenses-report', [
            'items' => $items,
            'detail' => $detail,
            'totals' => $totals,
        ]);
    }
}
