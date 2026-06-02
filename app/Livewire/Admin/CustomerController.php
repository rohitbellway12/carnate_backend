<?php

namespace App\Livewire\Admin;

use App\Models\{Admin,City, Staff, Country, State, Branch, Customer};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class CustomerController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $customerId,$add,$countries,$isEdits,$admin,$gst_no,$searchfilter,$pincode;
    public $states = [];
    public $cities = [];

    protected $listeners = ['delete'];

    protected $rules = [];

    public function mount()
    {
        $id = Auth::guard('admin')->user()->id;

       $this->admin = Admin::where('id', $id)->first();
        $this->countries = Country::all();

        $this->branches = Branch::get();
    }


    public function render()
    {
        $customers = Customer::with('user');
        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $customers->where(function($q) use ($search){
                $q->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$search%"])
                ->orWhere('email', 'LIKE', "%".$search."%")
                ->orWhere('mobile_no', 'LIKE', "%".$search."%");
            });

        }
        $customers = $customers->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.customer', compact('customers'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function colseModel(){
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {

        $valArr = [
            'name' => ["required"],
            'lastname' => ["nullable"],
            'email' => ["nullable",'email'],
            'mobile_no' => ['required', 'digits:10'],
            'pincode' => ['nullable', 'digits:6'],
            'address' => ["nullable"],
            'country_id' => ["nullable"],
            'state_id' => ["nullable"],
            'city_id' => ["nullable"],
            'user_title' => ["nullable"],
            'birth_date' => ["nullable"],
        ];

        $this->validate($valArr);

        $customer = new Customer();
        $customer->name = $this->name;
        $customer->lastname = $this->lastname;
        $customer->user_title = $this->user_title;
        $customer->birth_date = date('Y-m-d', strtotime($this->birth_date));
        $customer->email = $this->email;
        $customer->mobile_no = $this->mobile_no;
        $customer->address = $this->address;
        $customer->pincode = $this->pincode;
        $customer->country_id = $this->country_id;
        $customer->state_id = $this->state_id;
        $customer->city_id = $this->city_id;
        $customer->gst_number = $this->gst_no;
        $customer->save();


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $customer = Customer::findOrFail($id);

        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->lastname = $customer->lastname;
        $this->user_title = $customer->user_title;
        $this->email = $customer->email;
        $this->mobile_no = $customer->mobile_no;
        $this->branch_name = $customer->branch_name;
        $this->landline_no = $customer->landline_no;
        $this->country_id = $customer->country_id;
        $this->state_id = $customer->state_id;
        $this->city_id = $customer->city_id;
        $this->address = $customer->address;
        $this->pincode = $customer->pincode;
        $this->birth_date = $customer->birth_date;
        $this->display_name = $customer->display_name;
        $this->stateData($customer->country_id);
        $this->cityData($customer->state_id);
        $this->gst_no = $customer->gst_number;

        $this->showModal = true;
    }

    public function update()
    {

        $valArr = [
            'name' => ["required"],
            'lastname' => ["nullable"],
            'email' => ["nullable",'email'],
            'mobile_no' => ["required",'digits:10'],
            'pincode' => ['nullable', 'digits:6'],
            // 'address' => ["required"],
            // 'country_id' => ["required"],
            // 'state_id' => ["required"],
            // 'city_id' => ["required"],

        ];

        $this->validate($valArr);


        $customer = Customer::find($this->customerId);
        $customer->name = $this->name;
        $customer->lastname = $this->lastname;
        $customer->user_title = $this->user_title;
        $customer->birth_date = date('Y-m-d', strtotime($this->birth_date));
        $customer->email = $this->email;
        $customer->mobile_no = $this->mobile_no;
        $customer->address = $this->address;
        $customer->pincode = $this->pincode;
        $customer->country_id = $this->country_id;
        $customer->state_id = $this->state_id;
        $customer->city_id = $this->city_id;
         $customer->gst_number = $this->gst_no;
        $customer->save();


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer updated successfully!',
        ]);

        $this->showModal = false;
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

    public function confirmDelete($id)
    {
        $this->customerId = $id;
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
        Staff::destroy($this->customerId);
        $this->dispatch('swal:toast', ['message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->user_title = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
        $this->branch_name = '';
        $this->landline_no = '';
        $this->country_id = null;
        $this->state_id = null;
        $this->city_id = null;
        $this->address = '';
        $this->pincode = '';
        $this->birth_date = '';
        $this->display_name = '';
        $this->customerId = null;
        $this->states = [];
        $this->cities = [];
        $this->gst_no = '';
    }

    public function resetFilter(){
        $this->searchfilter ='';
    }

    public function updatedSearchfilter(){
        $this->resetPage();
    }

}
