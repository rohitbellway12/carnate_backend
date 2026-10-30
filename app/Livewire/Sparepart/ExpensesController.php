<?php namespace App\Livewire\Sparepart;

use App\Models\SparePartVendor;
use App\Models\Expense;
use App\Models\SparePartExpenseCategory;
use App\Models\SparePartSupplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class ExpensesController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false, $showSupplierModal = false;
    public $workshopId, $categories, $suppliers, $category_id, $supplier_id, $bill_number, $expense_date, $total_amount, $paid_amount, $balance_amount, $description, $expensesId, $showCategoryModel, $category_label, $user;
    public $states = [];
    public $cities = [], $searchfilter;

    protected $listeners = ['delete'];

    protected $rules = [
        'category_id' => 'required',
        'bill_number' => 'required',
        'expense_date' => 'required',
        'total_amount' => 'required',
    ];

    public function mount()
    {
        $this->workshopId = Auth::guard('sparepart')->user()->id;
        $this->user = SparePartVendor::where('id', $this->workshopId)->first();
        $this->suppliers = SparePartSupplier::where('user_id', $this->workshopId)->get();
        $this->categories = SparePartExpenseCategory::all();
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
        $user = SparePartVendor::find($this->workshopId);
        $parentIds = $user->parent_id == 0 ? [$this->workshopId] : [$this->workshopId, $user->parent_id];

        $items = Expense::with(['sparePartCategory', 'sparePartSupplier'])
            ->whereIn('parent_id', $parentIds);
        if ($this->searchfilter) {
            $items = $items->where(function ($query) {
                $query->Where('bill_number', 'like', '%' . $this->searchfilter . '%')
                    ->orWhereHas('sparePartSupplier', function ($query) {
                        $query->where('business_first_name', 'like', '%' . $this->searchfilter . '%');
                    });
            });
        }

        $items = $items->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.sparepart.expenses', compact('items'));
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        Expense::create([
            'category_id'     => $this->category_id,
            'supplier_id'     => $this->supplier_id ?: null,
            'bill_number'     => $this->bill_number,
            'date'            => $this->expense_date,
            'total_amount'    => $this->total_amount,
            'paid_amount'     => $this->paid_amount ?: 0,
            'balance_amount'  => $this->balance_amount,
            'description'     => $this->description,
            'parent_id'       => $this->workshopId,
        ]);

        $this->dispatch('swal:toast', ['message' => 'Expenses added successfully!']);
        $this->resetForm();
        $this->resetErrorBag();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->isEdit = true;
        $expenses = Expense::findOrFail($id);

        $this->expensesId = $expenses->id;
        $this->category_id = $expenses->category_id;
        $this->supplier_id = $expenses->supplier_id;
        $this->bill_number = $expenses->bill_number;
        $this->expense_date = $expenses->date;
        $this->total_amount = $expenses->total_amount;
        $this->paid_amount = $expenses->paid_amount;
        $this->balance_amount = $expenses->balance_amount;
        $this->description = $expenses->description;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $expenses = Expense::findOrFail($this->expensesId);
        $expenses->update([
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
            'bill_number' => $this->bill_number,
            'expense_date' => $this->expense_date,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'balance_amount' => $this->balance_amount,
            'description' => $this->description,
            'parent_id' => $this->workshopId,
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
        try {
            $expense = Expense::findOrFail($this->expensesId);
            $expense->delete();

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Expense deleted successfully!'
            ]);

            $this->reset('expensesId');
            $this->dispatch('expenseDeleted');
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Error deleting expense: ' . $e->getMessage()
            ]);
        }
    }

    public function addCategory()
    {
        $this->showCategoryModel = true;
    }

    public function categoryLabelStore()
    {
        $valArr = [
            'category_label' => ["required"],
        ];

        $this->validate($valArr);

        $category = SparePartExpenseCategory::create([
            'title' => $this->category_label,
        ]);

        $this->categories = SparePartExpenseCategory::all();
        $this->category_id = $category->id;
        $this->dispatch('swal:toast', ['message' => 'Category added successfully!']);
        $this->resetForm();
        $this->category_label = '';
        $this->showCategoryModel = false;
    }

    private function resetForm()
    {
        $this->category_id = '';
        $this->supplier_id = '';
        $this->bill_number = '';
        $this->expense_date = '';
        $this->total_amount = '';
        $this->paid_amount = '';
        $this->balance_amount = '';
        $this->description = '';
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

    public function openSupplierModal()
    {
        $this->resetErrorBag();
        $this->showSupplierModal = true;
    }

    public function saveSupplier()
    {
        $this->validate([
            'newSupplier.name' => 'required|string|max:255',
            'newSupplier.lastname' => 'nullable|string|max:255',
        ], [
            'newSupplier.name.required' => 'The supplier name field is required.',
        ]);

        $supplier = SparePartSupplier::create([
            'business_first_name' => trim($this->newSupplier['name']),
            'owner_first_name' => trim($this->newSupplier['lastname'] ?? ''),
            'mobile_no' => '',
            'contact_1' => '',
            'user_id' => $this->workshopId,
        ]);

        $this->suppliers = SparePartSupplier::where('user_id', $this->workshopId)->get();
        $this->supplier_id = (string) $supplier->id;
        $this->newSupplier = ['name' => '', 'lastname' => ''];
        $this->showSupplierModal = false;

        $this->dispatch('sync-searchable-selects');
        $this->dispatch('set-supplier-select', id: $supplier->id);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier added and selected successfully!'
        ]);
    }
}
