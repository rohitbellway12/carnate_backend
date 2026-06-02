<?php

namespace App\Livewire\Sparepart;

use App\Models\{Tools, Unit, SparePartLabel, UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]  
class UnitController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $title;
    public $unitId,$sparepartId,$searchfilter; 

    protected $listeners = ['delete'];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();
    }

    public function render()
    {  
        $units = Unit::orderBy('created_at', 'desc');
        if($this->searchfilter){
            $units = $units->Orwhere('title', 'like', '%' . $this->searchfilter . '%');
            
        }
        $units = $units->paginate(10);
        return view('livewire.sparepart.unit',compact('units'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
         $this->validate([
            'title' => 'required|unique:units,title', 
        ]);
  
       Unit::create([ 
            'title' => $this->title, 
        ]); 

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Unit added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $unit = Unit::findOrFail($id);

        $this->unitId = $unit->id;
        $this->title = $unit->title;  

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|unique:units,title,' . $this->unitId . ',id', 
        ]);

        $tools =Unit::findOrFail($this->unitId);
 
        $tools->update([ 
            'title' => $this->title, 
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Title updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->unitId = $id;
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
       Unit::destroy($this->unitId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Unit deleted successfully!']);
    }
 
    private function resetForm()
    {
        $this->title = '';  
    }

    public function closeModal(){
        $this->reset('showModal','title');
    }
    
     public function resetFilter(){
        $this->searchfilter ='';
        $this->resetPage();
    }
    public function updatedSearchfilter(){
        $this->resetPage();
    }
}
