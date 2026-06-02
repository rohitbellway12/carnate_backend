<?php

namespace App\Livewire\Admin;

use App\Models\{Plan, PlanDescription};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PlanController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $plan_name, $is_trial, $validity, $amount, $status, $description, $plan_type, $planDescription = [];
    public $planId,$adminId,$searchfilter;

    protected $listeners = ['delete'];

    protected $rules = [
        'plan_name' => 'required',
        'is_trial' => 'required',
        'validity' => 'required',
        'amount' => 'required',
        'status' => 'required',
        'description' => 'required',
        'plan_type' => 'required',
        'planDescription.*' => 'required|string', // Validate each description
    ];

   protected $messages = [ 
    'is_trial.required' => "The trial field is required.", 
    'planDescription.*.required' => 'The plan Description field is required.', 
];


    public function mount()
    {
        $this->planDescription = ['']; // Initialize with one empty description field
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        $items = Plan::orderBy('created_at', 'desc');
        if($this->searchfilter){
            $items=$items->where('plan_name', 'like', '%' . $this->searchfilter . '%')
            ->Orwhere('validity', 'like', '%' . $this->searchfilter . '%')
            ->Orwhere('description', 'like', '%' . $this->searchfilter . '%');
            
        }
        $items = $items->paginate(10);
        return view('livewire.admin.plan', compact('items'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }
    
    public function resetModal()
    {
        // $this->resetErrorBag(); 
        $this->resetValidation();
        $this->reset(['showModal', 'plan_name', 'amount', 'validity', 'is_trial', 'status', 'plan_type', 'description', 'planDescription']); 
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        // Create the Plan and get the model instance
        $plan = Plan::create([
            'plan_name' => $this->plan_name,
            'is_trial' => $this->is_trial,
            'validity' => $this->validity,
            'amount' => $this->amount,
            'status' => $this->status,
            'description' => $this->description,
            'plan_type' => $this->plan_type,
        ]);

        // Create associated PlanDescriptions
        foreach ($this->planDescription as $planDescriptionData) {
            PlanDescription::create([
                'description' => $planDescriptionData,
                'plan_id' => $plan->id,
            ]);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Plan added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;

        // Retrieve the plan and its descriptions
        $plan = Plan::with('planDescriptions')->findOrFail($id);

        $this->planId = $plan->id;
        $this->plan_name = $plan->plan_name;
        $this->is_trial = $plan->is_trial;
        $this->description = $plan->description;
        $this->validity = $plan->validity;
        $this->amount = $plan->amount;
        $this->status = $plan->status;
        $this->plan_type = $plan->plan_type;

        // Populate planDescription with existing descriptions
        $this->planDescription = $plan->planDescriptions->pluck('description')->toArray();

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $plan = Plan::findOrFail($this->planId);

        // Update plan data
        $plan->update([
            'plan_name' => $this->plan_name,
            'is_trial' => $this->is_trial,
            'description' => $this->description,
            'validity' => $this->validity,
            'amount' => $this->amount,
            'status' => $this->status,
            'plan_type' => $this->plan_type,
        ]);

        // Update or recreate plan descriptions
        $plan->planDescriptions()->delete(); // Remove old descriptions
        foreach ($this->planDescription as $planDescriptionData) {
            PlanDescription::create([
                'description' => $planDescriptionData,
                'plan_id' => $plan->id,
            ]);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Plan updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->planId = $id;
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
        Plan::destroy($this->planId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Plan deleted successfully!']);
    }

    public function addField()
    {
        $this->planDescription[] = '';
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Plan Description Field Added Successfully!']);
    }

    public function removeField($index)
    {
        unset($this->planDescription[$index]);
        $this->planDescription = array_values($this->planDescription);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Plan Description Field Removed Successfully!']);
    }

    private function resetForm()
    {
        $this->plan_name = '';
        $this->is_trial = '';
        $this->description = '';
        $this->validity = '';
        $this->amount = '';
        $this->plan_type = '';
        $this->status = '';
        $this->planId = null;
        $this->planDescription = ['']; // Reset descriptions
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    
    public function updatedSearchfilter(){
        $this->resetPage();
    } 
    
}
