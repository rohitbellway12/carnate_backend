<?php

namespace App\Livewire\Admin;

use App\Models\VehicleType;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleTypeController extends Component
{
    use WithPagination;
        
    public $isEdit,$showModal,$vehicleTypeId,$vehicle_type;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];
    
    public function render()
    {
        $vehicletypes = VehicleType::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.vehicle_type', compact('vehicletypes'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
       
        $valArr = [
            'vehicle_type' => ["required"],  
        ];

        $this->validate($valArr);
 
        $vehicleType = new VehicleType();
        $vehicleType->vehicle_type = $this->vehicle_type;  
        $vehicleType->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle Type added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $vehicletype = VehicleType::findOrFail($id);

        $this->vehicleTypeId = $vehicletype->id;
        $this->vehicle_type = $vehicletype->vehicle_type; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'vehicle_type' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $vehicleType = VehicleType::find($this->vehicleTypeId);
        $vehicleType->vehicle_type = $this->vehicle_type;  
        $vehicleType->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle type updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->vehicleTypeId = $id;
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
        VehicleType::destroy($this->vehicleTypeId);
        $this->dispatch('swal:toast', [ 'type' => 'success','message' => 'Vehicle type deleted successfully!']);
    }

    private function resetForm()
    {
        $this->vehicle_type = ''; 
    }

}
