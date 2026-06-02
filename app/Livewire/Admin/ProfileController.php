<?php

namespace App\Livewire\Admin;

use App\Models\{Admin, City, WorkShopVendor, Country, State, Branch, UploadImage};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

class ProfileController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date,$gst_number;
    public $vendorId,$adminId,$pincode;
    public $countries = [];  
    public $states = [];  
    public $cities = [];
    protected $listeners = ['delete'];

    protected $rules = [
        
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile_no' => 'required|digits:10',
        'pincode' => 'required|digits:6',
        'birth_date' => 'required|date',
        'country_id' => 'required',
        'state_id' => 'required',
        'city_id' => 'required',
        'address' => 'required|string',
        'gst_number' => 'nullable|string',
    ];

    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
        $this->isEdit = "Edit";

        
        $id = $this->adminId;

        $this->isEdit = true;
        $vendor = Admin::findOrFail($id);

        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->email = $vendor->email;
        $this->mobile_no = $vendor->mobile_no;
        $this->country_id = $vendor->country_id;
        $this->state_id = $vendor->state_id;
        $this->city_id = $vendor->city_id;
        $this->address = $vendor->address;
        $this->pincode = $vendor->pincode;
        $this->birth_date = $vendor->birth_date;
        $this->gst_number = $vendor->gst_number; 

        $this->stateData($vendor->country_id); 
        $this->cityData($vendor->state_id);  
        $this->countries = Country::all();

    }

    public function render()
    {
   
        return view('livewire.admin.profile');
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    } 

    public function update()
    {
        
        $this->validate();

        $vendor = Admin::findOrFail($this->vendorId);
        if($vendor->email != $this->email){
           if(Admin::where('email', $this->email)->whereNot('id',$this->vendorId)->exists()){
             $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'The email has already been taken!']);
            return;
           }
        }
        $vendor->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'birth_date' => $this->birth_date,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'gst_number' => $this->gst_number,
            
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Profile updated successfully!']);
        // $this->resetForm();
        // $this->showModal = false;
        // return redirect()->route('admin.profile');

    }

    public function stateData($countryId)
    {
        if ($countryId) {
            $this->states = State::where('country_id', $countryId)->get();
        } else {
            $this->states = [];
        }
    }

    public function cityData($stateId)
    {
        if ($stateId) {
            $this->cities = City::where('state_id', $stateId)->get();
        } else {
            $this->cities = [];
        }
    }  
     

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
        $this->country_id = null;
        $this->state_id = null;
        $this->city_id = null;
        $this->address = '';
        $this->pincode = '';
        $this->birth_date = '';
        $this->vendorId = null;
        $this->states = [];
        $this->cities = [];
    }
}
