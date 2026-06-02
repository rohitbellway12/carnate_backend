<?php

namespace App\Livewire\Workshop;

use App\Models\{City, WorkShopVendor, Country, State, Branch};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  
class EmployeeController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $employeeId,$workshopId;
    public $states = [];
    public $cities = [];

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'branch_name' => 'required|string',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'user_title' => 'required',
    ];

    public function mount()
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->branches = Branch::get();
    }

    public function render()
    {
        $items = WorkShopVendor::with('cityName')
            ->where('type', 1)
            ->orderBy('created_at', 'desc')
            ->where('parent_id', $this->workshopId)
            ->paginate(10);

        $countries = Country::all();

        return view('livewire.workshop.employee', compact('items', 'countries'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        WorkShopVendor::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : null,
            'mobile_no' => $this->mobile_no,
            'branch_name' => $this->branch_name,
            'landline_no' => $this->landline_no,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'type' => 1,
            'parent_id' => $this->workshopId,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Employee added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $employee = WorkShopVendor::findOrFail($id);

        $this->employeeId = $employee->id;
        $this->name = $employee->name;
        $this->lastname = $employee->lastname;
        $this->user_title = $employee->user_title;
        $this->email = $employee->email;
        $this->mobile_no = $employee->mobile_no;
        $this->branch_name = $employee->branch_name;
        $this->landline_no = $employee->landline_no;
        $this->country_id = $employee->country_id;
        $this->state_id = $employee->state_id;
        $this->city_id = $employee->city_id;
        $this->address = $employee->address;
        $this->birth_date = $employee->birth_date;
        $this->display_name = $employee->display_name;

        $this->stateData($employee->country_id); // Load states based on the country
        $this->cityData($employee->state_id);   // Load cities based on the state

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $employee = WorkShopVendor::findOrFail($this->employeeId);
        $employee->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'branch_name' => $this->branch_name,
            'landline_no' => $this->landline_no,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'parent_id' => $this->workshopId,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Employee updated successfully!']);
        $this->resetForm();
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
        $this->employeeId = $id;
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
        WorkShopVendor::destroy($this->employeeId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Employee deleted successfully!']);
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
        $this->birth_date = '';
        $this->display_name = '';
        $this->employeeId = null;
        $this->states = [];
        $this->cities = [];
    }
}
