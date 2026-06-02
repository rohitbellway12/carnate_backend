<?php

namespace App\Livewire\Admin;

use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseCategoryController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $isEdit,$showModal,$ExpencesEditId,$title,$adminId,$searchfilter;
    protected $listeners = ['delete'];

    public function mount(){
        $this->adminId = Auth::guard('admin')->user()->id;
    }
    public function render()
    {
        $expenses = ExpenseCategory::with('user');
        if($this->searchfilter){
            $expenses=$expenses->where('title', 'like', '%' . $this->searchfilter . '%');
            
        }
        $expenses = $expenses->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.expense_category', compact('expenses'));
    }

    
    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function colseModel(){
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {

        $this->validate([
            'title' => "required|unique:expense_categories,title",
        ], [
            'title.required' => 'The Expense Category field is required.',
            'title.unique' => 'The Expense Category has already been taken.'
        ]);
 
        $expenseCategory = new ExpenseCategory();
        $expenseCategory->title = $this->title;  
        $expenseCategory->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Expense Category added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $expenseCategory = ExpenseCategory::findOrFail($id);

        $this->ExpencesEditId = $expenseCategory->id;
        $this->title = $expenseCategory->title; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'title' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $expenseCategory = ExpenseCategory::find($this->ExpencesEditId);
        $expenseCategory->title = $this->title;  
        $expenseCategory->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Expense Category updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->ExpencesEditId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete',
        ]);
    }

    public function delete()
    {
        ExpenseCategory::destroy($this->ExpencesEditId);
        $this->dispatch('swal:toast', ['message' => 'Expense Category deleted successfully!']);
    }

    private function resetForm()
    {
        $this->title = ''; 
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    
    public function updatedSearchfilter(){
        $this->resetPage();
    }
    
    
}
