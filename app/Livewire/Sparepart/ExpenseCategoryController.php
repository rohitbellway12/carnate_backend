<?php namespace App\Livewire\Sparepart;

use App\Models\SparePartExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class ExpenseCategoryController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal, $expenseCategoryId, $title, $sparepartId, $searchfilter;
    protected $listeners = ['delete'];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
    }

    public function render()
    {
        $query = SparePartExpenseCategory::query();
        if ($this->searchfilter) {
            $query->where('title', 'like', '%' . $this->searchfilter . '%');
        }
        $categories = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.sparepart.expense_category', compact('categories'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModel()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:spare_part_expense_categories,title',
        ], [
            'title.required' => 'The Expense Category field is required.',
            'title.unique' => 'The Expense Category has already been taken.'
        ]);

        SparePartExpenseCategory::create([
            'title' => $this->title,
        ]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Expense Category added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $category = SparePartExpenseCategory::findOrFail($id);
        $this->expenseCategoryId = $category->id;
        $this->title = $category->title;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
        ]);

        $category = SparePartExpenseCategory::findOrFail($this->expenseCategoryId);
        $category->title = $this->title;
        $category->save();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Expense Category updated successfully!',
        ]);

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->expenseCategoryId = $id;
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
        SparePartExpenseCategory::destroy($this->expenseCategoryId);
        $this->dispatch('swal:toast', ['message' => 'Expense Category deleted successfully!']);
    }

    private function resetForm()
    {
        $this->title = '';
        $this->expenseCategoryId = null;
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }
}
