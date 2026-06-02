<?php

namespace App\Livewire\Admin;

use App\Models\{Mmodel, MakerType, Maker};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ModelsController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal;
    public $title, $maker_type_id, $maker_id, $status;
    public $model_id = false;
    public $makertypes=[], $makers=[] ;
    public  $search, $status_filter,$adminId;

    protected $listeners = ['delete'];

    protected $rules = [
        'title' => 'required|string',
        'maker_type_id' => 'required',
        'maker_id' => 'required',
        'status' => 'required',
    ];

    public function mount(){
        // $this->makertypes = MakerType::where(['status' => 1])->get();
        $this->makers = Maker::where(['status' => 1])->get();
        $this->makertypes = MakerType::all();
        // $this->makers = Maker::all();
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        // $items = Mmodel::orderBy('created_at', 'desc')->paginate(10); 

      
        $items = Mmodel::query()
            ->when(filled($this->search), function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhereHas('makerType', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('maker', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    });
                });
            })
            ->when(filled($this->maker_type_id), function ($query) {
                $query->where('maker_type_id', $this->maker_type_id);
            })
            ->when(filled($this->maker_id), function ($query) {
                $query->where('maker_id', $this->maker_id);
            })
            ->when(filled($this->status_filter), function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('livewire.admin.models', compact('items'));
    }


    public function create()
    {
        $this->resetForm(); 
        $this->makertypes = MakerType::all();
        // $this->makers = Maker::all();
        $this->isEdit = false; 
        $this->showModal = true;
    }

    public function closeModel(){
        $this->resetValidation();
        $this->resetForm(); 
        $this->showModal = false;
    }

    public function store()
    {
        
        $this->validate();

        Mmodel::create([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'maker_id' => $this->maker_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model added successfully!']);
        $this->resetForm();
        $this->showModal = ""; 
    }

    public function edit($id)
    {
        $this->isEdit = true; 

        $model = Mmodel::findOrFail($id);
    
        $this->model_id = $model->id;
        $this->title = $model->title;
        $this->status = $model->status;
        $this->maker_type_id = $model->maker_type_id;
        $this->maker_id = $model->maker_id;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $receipt = Mmodel::findOrFail($this->model_id);
        $receipt->update([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'maker_id' => $this->maker_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model updated successfully!']);    
        $this->resetForm();
        $this->showModal = false; 
    }

    public function confirmDelete($id)
    {
        $this->model_id = $id;
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
        Mmodel::destroy($this->model_id);
        $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Model deleted successfully!']); 
    }

    public function toggleStatus($id,$status)   
    {    
       
         $model = Mmodel::find($id);

         if ($model) {
            
             $model->update(['status' => $status]);
             $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Status updated successfully']);
         } else {
            $this->dispatch('swal:toast', ['type' => 'error','title'=>'', 'message' => 'Model not found.']); 
         }
    }

    private function resetForm()
    {
        // Reset form fields
        $this->title = '';
        $this->maker_type_id = '';
        $this->maker_id = '';
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

    public function resetFilter()
    {
        $this->reset(['search','maker_type_id','maker_id','status_filter']);
    }
    
    public function updatedSearch(){
        $this->resetPage();
    } 

    public function updatedMakerId(){
        $this->resetPage();
    } 
    public function updatedStatusFilter(){
        $this->resetPage();
    } 


}
