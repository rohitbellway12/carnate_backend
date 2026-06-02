<?php

namespace App\Livewire\Admin;

use App\Models\Fueltype;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleFuelController extends Component
{
    use WithPagination;
    public $isEdit,$showModal,$FueltypeId,$fuel_type;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];
    

    public function render()
    {
        $vehiclefuletypes = Fueltype::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.vehcle_fuel_level', compact('vehiclefuletypes'));
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
            'fuel_type' => ["required"],  
        ];

        $this->validate($valArr);
 
        $fueltype = new Fueltype();
        $fueltype->fuel_type = $this->fuel_type;  
        $fueltype->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Fuel type added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $fueltype = Fueltype::findOrFail($id);

        $this->FueltypeId = $fueltype->id;
        $this->fuel_type = $fueltype->fuel_type; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'fuel_type' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $fueltype = Fueltype::find($this->FueltypeId);
        $fueltype->fuel_type = $this->fuel_type;  
        $fueltype->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Fuel type updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->FueltypeId = $id;
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
        Fueltype::destroy($this->FueltypeId);
        $this->dispatch('swal:toast', [ 'type' => 'success','message' => 'Fuel type deleted successfully!']);
    }

    private function resetForm()
    {
        $this->vehicle_type = ''; 
    }

}
