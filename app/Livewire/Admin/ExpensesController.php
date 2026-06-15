<?php

namespace App\Livewire\Admin;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-app')]
class ExpensesController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $adminId, $categories, $category_id, $bill_number, $expense_date, $total_amount, $paid_amount, $balance_amount, $description, $expensesId;
    public $searchfilter;

    protected $listeners = ['delete'];

    protected $rules = [
        'category_id' => 'required',
        'bill_number' => 'required',
        'expense_date' => 'required',
        'total_amount' => 'required',
    ];

    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
        $this->categories = ExpenseCategory::all();
    }

    public function updatedTotalAmount()
    {
        $this->calculateBalance();
    }

    public function updatedPaidAmount()
    {
        $this->calculateBalance();
    }

    private function calculateBalance()
    {
        $this->balance_amount = max((float)$this->total_amount - (float)$this->paid_amount, 0);
    }

    public function render()
    {
        $expenses = Expense::where('parent_id', $this->adminId);
        if ($this->searchfilter) {
            $expenses = $expenses->where('bill_number', 'like', '%' . $this->searchfilter . '%');
        }
        $expenses = $expenses->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.expenses', compact('expenses'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    private function resetForm()
    {
        $this->category_id = '';
        $this->bill_number = '';
        $this->expense_date = '';
        $this->total_amount = '';
        $this->paid_amount = '';
        $this->balance_amount = '';
        $this->description = '';
    }

    public function store()
    {
        $this->validate();
        Expense::create([
            'category_id' => $this->category_id,
            'bill_number' => $this->bill_number,
            'date' => $this->expense_date,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount ?: 0,
            'balance_amount' => $this->balance_amount,
            'description' => $this->description,
            'parent_id' => $this->adminId,
        ]);
        $this->dispatch('swal:toast', ['message' => 'Expenses added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $expense = Expense::findOrFail($id);
        $this->expensesId = $expense->id;
        $this->category_id = $expense->category_id;
        $this->bill_number = $expense->bill_number;
        $this->expense_date = $expense->date;
        $this->total_amount = $expense->total_amount;
        $this->paid_amount = $expense->paid_amount;
        $this->balance_amount = $expense->balance_amount;
        $this->description = $expense->description;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $expense = Expense::findOrFail($this->expensesId);
        $expense->update([
            'category_id' => $this->category_id,
            'bill_number' => $this->bill_number,
            'date' => $this->expense_date,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'balance_amount' => $this->balance_amount,
            'description' => $this->description,
        ]);
        $this->dispatch('swal:toast', ['message' => 'Expenses updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->expensesId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This expense will be permanently deleted!',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete',
        ]);
    }

    public function delete()
    {
        Expense::destroy($this->expensesId);
        $this->dispatch('swal:toast', ['message' => 'Expense deleted successfully!']);
        $this->reset('expensesId');
    }
}
