<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SparePartCategory;
use Illuminate\Support\Facades\Auth;

class SparePartCategoryController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    
    public $isEdit,$showModal,$sparePartCategoryId,$sparepart_label,$category_title,$adminId,$searchfilter;
    protected $listeners = ['delete'];
    public function mount(){
        $this->adminId = Auth::guard('admin')->user()->id;
    }
    public function render()
    {
        $categories = SparePartCategory::with('user');
        if($this->searchfilter){
            $categories=$categories->where('title', 'like', '%' . $this->searchfilter . '%');
            
        }
         $categories = $categories->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.spare_part_category', compact('categories'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModel(){
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {
       
        $valArr = [
            'category_title' => ["required"],  
        ];

        $this->validate($valArr);
 
        $sparePartCategory = new SparePartCategory();
        $sparePartCategory->title = $this->category_title;  
        $sparePartCategory->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Category added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $sparePartCategory = SparePartCategory::findOrFail($id);
        $this->sparePartCategoryId = $sparePartCategory->id;
        $this->category_title = $sparePartCategory->title; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'category_title' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $sparePartCategory = SparePartCategory::find($this->sparePartCategoryId);
        $sparePartCategory->title = $this->category_title;  
        $sparePartCategory->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Category updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->sparePartCategoryId = $id;
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
        SparePartCategory::destroy($this->sparePartCategoryId);
        $this->dispatch('swal:toast', ['message' => 'Spare Part Category deleted successfully!']);
    }

    private function resetForm()
    {
        $this->sparepart_label = ''; 
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    
      public function updatedSearchfilter(){
        $this->resetPage();
    }    

}
