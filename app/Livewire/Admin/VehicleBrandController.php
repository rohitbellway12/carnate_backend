<?php

namespace App\Livewire\Admin;

use App\Models\Vehiclebrand;
use App\Models\VehicleType;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleBrandController extends Component
{
    use WithPagination;
            
    public $isEdit,$showModal,$vehicleBrandId,$vehicle_type,$vehicle_brand,$vehicleTypes;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];

    
    public function mount()
    {
        $this->vehicleTypes = VehicleType::all(); 
 
    }

    public function render()
    {
        $vehiclebrands = Vehiclebrand::with('vehiclebrandtype')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.vehicle_brand', compact('vehiclebrands'));
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
            'vehicle_brand' => ["required"],  
        ];

        $this->validate($valArr);
 
        $vehicleBrand = new Vehiclebrand();
        $vehicleBrand->vehicle_type_id = $this->vehicle_type;  
        $vehicleBrand->vehicle_brand = $this->vehicle_brand;  
        $vehicleBrand->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle Brand added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $vehiclebrand = Vehiclebrand::findOrFail($id);

        $this->vehicleBrandId = $vehiclebrand->id;
        $this->vehicle_type = $vehiclebrand->vehicle_type_id; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'vehicle_type' => ["required"],  
            'vehicle_brand' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $vehicleBrand = Vehiclebrand::find($this->vehicleBrandId);
        $vehicleBrand->vehicle_type_id = $this->vehicle_type;  
        $vehicleBrand->vehicle_brand = $this->vehicle_brand;  
        $vehicleBrand->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle brand updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->vehicleBrandId = $id;
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
        Vehiclebrand::destroy($this->vehicleBrandId);
        $this->dispatch('swal:toast', [ 'type' => 'success','message' => 'Vehicle brand deleted successfully!']);
    }

    private function resetForm()
    {
        $this->vehicle_type = ''; 
        $this->vehicle_brand = ''; 
    }

    
}
