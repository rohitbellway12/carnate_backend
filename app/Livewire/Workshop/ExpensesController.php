<?php

namespace App\Livewire\Workshop;

use App\Models\{City, Staff, Country, State, Branch, WorkShopVendor,Suppliers, WorkshopSupplier};
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  
class ExpensesController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches;
    public $staffId,$workshopId,$categories,$suppliers,$category_id,$supplier_id,$bill_number,$expense_date,$total_amount,$paid_amount,$balance_amount,$description,$expensesId,$showCategoryModel,$category_label,$user;
    public $states = [];
    public $cities = [],$searchfilter;
   
public $showSupplierModal = false;
public $newSupplier = [
    'name' => '',
    'lastname' => ''
];

    protected $listeners = ['delete'];

    protected $rules = [ 
        'category_id' => 'required', 
        'bill_number' => 'required',
        'expense_date' => 'required',
        'total_amount' => 'required',  
    ];

    public function mount()
    { 
        $this->workshopId = Auth::guard('workshop')->user()->id; 
        $this->user = WorkShopVendor::where('id', $this->workshopId)->first();
        // $this->suppliers = Staff::all();
        $this->suppliers = WorkshopSupplier::where('user_id', $this->workshopId)->get();
        $this->categories = \App\Models\WorkshopExpenseCategory::all();
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

        $user = WorkShopVendor::find($this->workshopId);

        $parentIds = $user->parent_id == 0 ? [$this->workshopId] : [$this->workshopId, $user->parent_id];

        $items = Expense::with('workshopCategory', 'workshopSupplier')
            ->whereIn('parent_id', $parentIds);
            if($this->searchfilter){
                $items = $items->where(function ($query) {
                    $query->Where('bill_number', 'like', '%' . $this->searchfilter . '%')
                    ->OrwhereHas('workshopSupplier', function ($query) {
                        $query->where('business_first_name', 'like', '%' . $this->searchfilter . '%'); 
                    });

                });
            }
            
        $items = $items->orderBy('created_at', 'desc')
            ->paginate(10);
        


        return view('livewire.workshop.expenses', compact('items'));
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


    // public function confirmDelete($id)
    // {
    
    //     $this->dispatch('swal:confirm', [
    //         'title' => 'Are you sure?',
    //         'text' => 'This action cannot be undone.',
    //         'icon' => 'warning',
    //         'showCancelButton' => true,
    //         'confirmButtonText' => 'Yes, delete it!',
    //         'cancelButtonText' => 'Cancel',
    //         'action' => 'delete',
    //     ]);
    // }

    // public function delete()
    // {
       
    //     Expense::destroy($this->expensesId);
    //     $this->dispatch('swal:toast', ['message' => 'Expenses deleted successfully!']);
    // }




public function confirmDelete($id)
{
    $this->expensesId = $id; // Store the ID for deletion
    
    $this->dispatch('swal:confirm', [
        'title' => 'Are you sure?',
        'text' => 'This expense will be permanently deleted!',
        'icon' => 'warning',
        'showCancelButton' => true,
        'confirmButtonText' => 'Yes, delete it!',
        'cancelButtonText' => 'Cancel',
        'action' => 'delete', // Changed to more specific action name
    ]);
}

public function delete()
{
   
    try {
        // Find and delete the expense
        $expense = Expense::findOrFail($this->expensesId);
        $expense->delete();
        
        // Show success message
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Expense deleted successfully!'
        ]);
        
        // Reset the ID
        $this->reset('expensesId');
        
        // Optional: emit event to refresh data
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

        $category = \App\Models\WorkshopExpenseCategory::create([
        'title' => $this->category_label,
        ]);
    
        $this->categories = \App\Models\WorkshopExpenseCategory::all();
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
    
     public function resetFilter(){
        $this->searchfilter ='';
    }
    public function updatedSearchfilter(){
        $this->resetPage();
    }
    public function openSupplierModal()
{
    $this->resetErrorBag();
    $this->newSupplier = ['name' => '', 'lastname' => ''];
    $this->showSupplierModal = true;
}

public function saveSupplier()
{
    $this->validate([
        'newSupplier.name' => 'required|string|max:255',
        'newSupplier.lastname' => 'required|string|max:255',
    ]);

    $supplier = WorkshopSupplier::create([
        'business_first_name' => $this->newSupplier['name'],
        'owner_first_name' => $this->newSupplier['lastname'],
        'mobile_no' => '',
        'contact_1' => '',
        'user_id' => $this->workshopId,
    ]);
    $this->suppliers = WorkshopSupplier::where('user_id', $this->workshopId)->get();
    $this->supplier_id = $supplier->id; // Auto-select the newly added
    $this->showSupplierModal = false;
}
}
