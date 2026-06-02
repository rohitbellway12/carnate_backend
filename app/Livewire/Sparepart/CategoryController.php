<?php

namespace App\Livewire\Sparepart;

use App\Models\Category;
use App\Services\SparePartCategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class CategoryController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $title;
    public $categoryId, $sparepartId, $searchfilter;

    protected $listeners = ['delete'];

    protected $rules = [
        'title' => 'required|unique:categories,title',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();
        SparePartCategoryService::syncParentsFromApi();
    }

    public function render()
    {
        $parentNames = SparePartCategoryService::getRootNames();

        $categories = Category::orderBy('title', 'asc');

        if (!empty($parentNames)) {
            $categories->whereIn('title', $parentNames);
        }

        if ($this->searchfilter) {
            $categories->where('title', 'like', '%' . $this->searchfilter . '%');
        }

        $categories = $categories->paginate(10);

        return view('livewire.sparepart.category', compact('categories'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        $title = trim($this->title);

        Category::create(['title' => $title]);

        SparePartCategoryService::addCustomParent($title);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Category added successfully!']);
        $this->reset(['title']);
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->title = $category->title;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|unique:categories,title,' . $this->categoryId,
        ]);

        $category = Category::findOrFail($this->categoryId);
        $oldTitle = $category->title;
        $newTitle = trim($this->title);

        $category->update(['title' => $newTitle]);

        if ($oldTitle !== $newTitle) {
            SparePartCategoryService::renameCustomParent($oldTitle, $newTitle);
        } else {
            SparePartCategoryService::addCustomParent($newTitle);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Category updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
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
        $category = Category::find($this->categoryId);
        if ($category) {
            SparePartCategoryService::removeCustomParent($category->title);
            $category->delete();
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Category deleted successfully!']);
    }

    private function resetForm()
    {
        $this->title = '';
        $this->isEdit = false;
        $this->categoryId = null;
    }

    public function closeMdodel()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
        $this->resetPage();
    }

    public function updatedResetfilter()
    {
        $this->resetPage();
    }
}
