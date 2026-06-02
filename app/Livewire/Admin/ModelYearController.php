<?php

namespace App\Livewire\Admin;

use App\Models\{Mmodel, MakerType, Maker, ModelYear};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ModelYearController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal;
    public $title, $maker_type_id, $maker_id, $model_id, $status;
    public $modelyear_id = false;
    public $makertypes=[], $makers=[], $models=[] ;
    public  $search, $status_filter,$adminId;

    protected $listeners = ['delete'];

    protected $rules = [
        'title' => 'required|string',
        'maker_type_id' => 'required',
        'maker_id' => 'required',
        'model_id' => 'required',
        'status' => 'required',
    ];

    public function mount(){
        $this->makertypes = MakerType::all();
        // $this->makers = Maker::all();
        // $this->models = Mmodel::all();
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        // $items = ModelYear::orderBy('created_at', 'desc')->paginate(10); 

        $items = ModelYear::query()

        ->when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhereHas('makerType', function ($q) {
                      $q->where('title', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('maker', function ($q) {
                      $q->where('title', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('model', function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%');
                });
        })
       
        ->when($this->maker_type_id, function ($query) {
            $query->where('maker_type_id', $this->maker_type_id);
        })
        
        ->when($this->maker_id, function ($query) {
            $query->where('maker_id', $this->maker_id);
        })

        ->when($this->model_id, function ($query) {
            $query->where('model_id', $this->model_id);
        })
        
        ->when($this->status_filter != '', function ($query) {
            $query->where('status', $this->status_filter);
        })
        
        ->orderBy('created_at', 'desc')
        
        ->paginate(10);

        return view('livewire.admin.models_year', compact('items'));
    }


    public function create()
    {
        $this->resetForm(); 
        $this->makertypes = MakerType::all();
        // $this->makers = Maker::all();
        // $this->models = Mmodel::all();
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
        
        $this->validate();

        ModelYear::create([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'maker_id' => $this->maker_id,
            'model_id' => $this->model_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model Year added successfully!']);
        $this->resetForm();
        $this->showModal = ""; 
    }

    public function edit($id)
    {
        $this->isEdit = true; 

        $modelyear = ModelYear::findOrFail($id);
    
        $this->modelyear_id = $modelyear->id;
        $this->title = $modelyear->title;
        $this->status = $modelyear->status;
        $this->maker_type_id = $modelyear->maker_type_id;
        $this->maker_id = $modelyear->maker_id;
        $this->model_id = $modelyear->model_id;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $receipt = ModelYear::findOrFail($this->modelyear_id);
        $receipt->update([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'maker_id' => $this->maker_id,
            'model_id' => $this->model_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model Year updated successfully!']);    
        $this->resetForm();
        $this->showModal = false; 
    }

    public function confirmDelete($id)
    {
        $this->modelyear_id = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action'=>'delete'
        ]);
     }

    
    public function delete()
    {
        ModelYear::destroy($this->modelyear_id);
        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model Year deleted successfully!']); 
    }

    public function toggleStatus($id,$status)   
    {    
       
         $modelyear = ModelYear::find($id);

         if ($modelyear) {
            
             $modelyear->update(['status' => $status]);
             $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Status updated successfully']);
         } else {
            $this->dispatch('swal:toast', ['type' => 'error','title'=>'', 'message' => 'Model Year not found.']); 
         }
    }

    private function resetForm()
    {
        // Reset form fields
        $this->title = '';
        $this->maker_type_id = '';
        $this->maker_id = '';
        $this->model_id = '';
        $this->status = null;

    }

    public function updatedMakerTypeId($value)
    {
        if ($this->maker_type_id) {
           
            $this->makers = Maker::where('maker_type_id', $this->maker_type_id)->get();

        } else {
            
            $this->makers = [];
        }
        $this->resetPage();
    }

    public function updatedMakerId($value)
    {
        if ($this->maker_id) {
           
            $this->models = Mmodel::where('maker_id', $this->maker_id)->get();

        } else {
            
            $this->models = [];
        }
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset(['search','maker_type_id','maker_id','model_id','status_filter']);
    }
    public function updatedSearch(){
        $this->resetPage();
    }   

}
