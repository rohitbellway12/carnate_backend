<?php

namespace App\Livewire\Admin;

use App\Models\{City, Admin, Country, State, Branch, Role};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SubAdminController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date;
    public $subadminId, $role, $adminId;
    public $states = [];
    public $cities = [], $roles = [], $countries = [], $searchfilter, $pincode;

    protected $listeners = ['delete'];
    public function rules()
    {
        return [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($this->subadminId)
            ],
            'password' => $this->isEdit ? 'nullable|min:6' : 'required|min:6',
            'mobile_no' => 'required|digits:10',
            'pincode' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'user_title' => 'required',
            'role' => 'required',
            'birth_date' => 'nullable',
        ];
    }


    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
        $this->countries = Country::all();
    }
    public function render()
    {
        $items = Admin::with('cityName')
            ->orderBy('created_at', 'desc')
            ->where('type', 1);

        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $items->where(function($query) use ($search) {
                $query->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$search%"])
                      ->orWhere('email', 'LIKE', "%$search%")
                      ->orWhere('mobile_no', 'LIKE', "%$search%");
            });
        }

        $items = $items->paginate(10);

        $names = Admin::selectRaw("name, lastname, CONCAT(name, ' ', lastname) as full_name")->where('type', 1)
            ->groupBy('name', 'lastname')
            ->orderBy('name', 'asc')
            ->get();


        $this->roles = Role::whereNot('name', 'Super-Admin')->where('guard_name', 'admin')->get();

        return view('livewire.admin.subadmin', compact('items', 'names'));
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


        $subAdmin = Admin::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : null,
            'mobile_no' => $this->mobile_no,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'type' => 1,
            'parent_id' => Auth::guard('admin')->id(),
            'role_type' => $this->role
        ]);

        $role = Role::where('id', $this->role)->first();
        if ($role) {
            $subAdmin->syncRoles([$role->name]);
        }


        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Sub Admin added successfully!']);
        $this->resetForm();
        $this->showModal = false;
        $this->resetPage();
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $subadmin = Admin::findOrFail($id);

        $this->subadminId = $subadmin->id;
        $this->name = $subadmin->name;
        $this->lastname = $subadmin->lastname;
        $this->user_title = $subadmin->user_title;
        $this->email = $subadmin->email;
        $this->mobile_no = $subadmin->mobile_no;
        $this->country_id = $subadmin->country_id;
        $this->state_id = $subadmin->state_id;
        $this->city_id = $subadmin->city_id;
        $this->address = $subadmin->address;
        $this->pincode = $subadmin->pincode;
        $this->birth_date = $subadmin->birth_date;
        $this->role = $subadmin->role_type;

        $this->stateData($subadmin->country_id); // Load states based on the country
        $this->cityData($subadmin->state_id);   // Load cities based on the state

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $subadmin = Admin::findOrFail($this->subadminId);
        $subadmin->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'type' => 1,
            'role_type' => $this->role,
            'parent_id' => Auth::guard('admin')->user()->id,
        ]);

        $roles = Role::where('id', $this->role)->first();
        $subadmin->syncRoles([$roles->name]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Sub Admin updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
        $this->resetPage();
    }

    public function closeModel()
    {
        $this->resetForm();
        $this->showModal = false;
        $this->resetValidation();
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
        $this->subadminId = $id;
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
        Admin::destroy($this->subadminId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Sub Admin deleted successfully!']);
    }

    private function resetForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->user_title = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
        $this->country_id = null;
        $this->state_id = null;
        $this->city_id = null;
        $this->address = '';
        $this->pincode = '';
        $this->birth_date = '';
        $this->subadminId = null;
        $this->states = [];
        $this->cities = [];
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

}
