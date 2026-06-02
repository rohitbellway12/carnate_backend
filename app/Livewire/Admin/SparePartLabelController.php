<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SparePartLabel;
use Illuminate\Support\Facades\Auth;

class SparePartLabelController extends Component
{
    use WithPagination;

    public $isEdit,$showModal,$sparePartLabelId,$sparepart_label,$sparepart_category,$adminId,$searchfilter,$searchcategory;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];

    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
          $spareparelabels = SparePartLabel::with('user');
            if($this->searchfilter){
                $spareparelabels=$spareparelabels->where('title', 'like', '%' . $this->searchfilter . '%');
                
            }
            if($this->searchcategory){
                $spareparelabels=$spareparelabels->where('spare_part_type', $this->searchcategory);
                
            }
            $spareparelabels = $spareparelabels->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.spare_part_label', compact('spareparelabels'));
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
            'sparepart_label' => ["required"], 
            'sparepart_category' => ["required"], 
        ];

        $this->validate($valArr);
 
        $sparePartLabel = new SparePartLabel();
        $sparePartLabel->title = $this->sparepart_label; 
        $sparePartLabel->spare_part_type = $this->sparepart_category; 
        $sparePartLabel->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Label added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $sparePartLabel = SparePartLabel::findOrFail($id);

        $this->sparePartLabelId = $sparePartLabel->id;
        $this->sparepart_label = $sparePartLabel->title;
        $this->sparepart_category = $sparePartLabel->spare_part_type; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'sparepart_label' => ["required"], 
            'sparepart_category' => ["required"], 
        ];

        $this->validate($valArr);
 
        
        $sparePartLabel = SparePartLabel::find($this->sparePartLabelId);
        $sparePartLabel->title = $this->sparepart_label; 
        $sparePartLabel->spare_part_type = $this->sparepart_category; 
        $sparePartLabel->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Label updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->sparePartLabelId = $id;
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
        SparePartLabel::destroy($this->sparePartLabelId);
        $this->dispatch('swal:toast', ['message' => 'Spare Part Label deleted successfully!']);
    }

    private function resetForm()
    {
        $this->sparepart_label = '';
        $this->sparepart_category = '';
        
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
        $this->searchcategory ='';
    }
    
    public function updatedSearchfilter(){
        $this->resetPage();
    }
    public function updatedSearchcategory(){
        $this->resetPage();
    }
    
}
