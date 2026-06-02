<?php

namespace App\Livewire\Admin;

use App\Models\Vehiclebrand;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleModelController extends Component
{
    use WithPagination;
    public $isEdit,$showModal,$vehicleModelId,$vehicle_type,$vehicle_brand,$vehicleBrands,$vehicle_model;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];

    
    public function mount()
    {
        $this->vehicleBrands = Vehiclebrand::all(); 
 
    }

    public function render()
    {
        $vehiclemodels = VehicleModel::with('vehiclebrand')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.vehicle_model', compact('vehiclemodels'));
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
            'vehicle_model' => ["required"],  
            'vehicle_brand' => ["required"],  
        ];

        $this->validate($valArr);
 
        $vehicleModel = new VehicleModel();
        $vehicleModel->brand_id = $this->vehicle_brand;  
        $vehicleModel->model_name = $this->vehicle_model;  
        $vehicleModel->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle model added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $vehicleModel = VehicleModel::findOrFail($id);

        $this->vehicleModelId = $vehicleModel->id;
        $this->vehicle_brand = $vehicleModel->brand_id; 
 
        $this->showModal = true;
    }

    public function update()
    {
         
        $valArr = [
            'vehicle_model' => ["required"],  
            'vehicle_brand' => ["required"],  
        ];

        $this->validate($valArr);
 
        
        $vehicleModel = VehicleModel::find($this->vehicleModelId);
        $vehicleModel->brand_id = $this->vehicle_brand;  
        $vehicleModel->model_name = $this->vehicle_model;  
        $vehicleModel->save(); 
 

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Vehicle model updated successfully!',
        ]);

        $this->showModal = false;
    }

    
    public function confirmDelete($id)
    {
        $this->vehicleModelId = $id;
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
        VehicleModel::destroy($this->vehicleModelId);
        $this->dispatch('swal:toast', [ 'type' => 'success','message' => 'Vehicle model deleted successfully!']);
    }

    private function resetForm()
    {
        $this->vehicle_brand = ''; 
        $this->vehicle_model = ''; 
    }

}
