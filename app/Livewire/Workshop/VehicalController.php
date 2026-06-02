<?php

namespace App\Livewire\Workshop;

use App\Models\{City, WorkShopVendor, Vehicle, State, Branch ,JobCard,User};
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  
class VehicalController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isVehical,$showVehical,$isBrand,$showBrand,$isModel
    ,$showModel,$isFuel,$showFuel,$vehicleDetails;
    public $vehicle_id ,$vehicleBrand,$modelName,$fuel_id,$odometerReading,$numberPlate,$chassisNo,$modelYear,$noOfGear;
    public $dateOfManufacturing,$gearbox,$gearboxNo,$engineN,$engineSize,$engine,$keyNo,$engineNo;
    public $isEdit = false;
    public $fields = [];
    public $vehicleType = '';
    public $vehicleTypes = [];
    public $brandType = '';
    public $brandTypes = [];
    public $modelType = '';
    public $modelTypes = [];
    public $fuelType = '';
    public $fuelTypes = [];

   

    protected $listeners = ['delete'];

    protected $rules = [
        'vehicleType' => 'required|string|max:255',
    ];

   
    public function mount()
    {
      

    }

    public function render()
    {
        $this->isEdit = false;
        $this->vehicleDetails = true;
        return view('livewire.workshop.jobcard.vehical_modal');
        
    }
   
    public function addVehicalType(){
        $this->isVehical = false;
        $this->showVehical = true;
    }

    public function addBrandType(){
        $this->isBrand = false;
        $this->showBrand = true;
    }

    public function addModelType(){
        $this->isModel = false;
        $this->showModel = true;
    }

    public function addFuelType(){
        $this->isFuel = false;
        $this->showFuel = true;
    }

    public function addVehicleType()
    {
        $this->validate();
        $this->vehicleTypes[] = $this->vehicleType;
        $this->vehicleType = ''; 
    }

    public function removeVehicleType($index)
    {
        unset($this->vehicleTypes[$index]);
        $this->vehicleTypes = array_values($this->vehicleTypes); 
    }

    public function addBrandsType()
    {
       
        $this->brandTypes[] = $this->brandType;
        $this->brandType = ''; 
    }

    public function removeBrandsType($index)
    {
        unset($this->brandTypes[$index]);
        $this->brandTypes = array_values($this->brandTypes); 
    }

    public function addModelsType()
    {
       
        $this->modelTypes[] = $this->modelType;
        $this->modelType = ''; 
    }

    public function removeFuelsType($index)
    {
        unset($this->fuelTypes[$index]);
        $this->fuelTypes = array_values($this->fuelTypes); 
    }

    public function addFuelsType()
    {
       
        $this->fuelTypes[] = $this->fuelType;
        $this->fuelType = ''; 
    }

    public function removeModelsType($index)
    {
        unset($this->modelTypes[$index]);
        $this->modelTypes = array_values($this->modelTypes); 
    }

    public function closeModal()
    {
        $this->vehicleDetails = false;
        $this->emit('hideModal');
    }


    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
    }

    public function vehicleData()
    {
        echo"hello";die;
    }


    public function delete()
    {
        WorkShopVendor::destroy($this->staffId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        // $this->name = '';
        // $this->lastname = '';
        // $this->gender = '';
        // $this->email = '';
        // $this->password = '';
        // $this->mobile_no = '';
        // $this->branch_name = '';
        // $this->landline_no = '';
        // $this->country_id = null;
        // $this->state_id = null;
        // $this->city_id = null;
        // $this->address = '';
        // $this->birth_date = '';
        // $this->display_name = '';
        // $this->staffId = null;
        // $this->states = [];
        // $this->cities = [];
    }
}
