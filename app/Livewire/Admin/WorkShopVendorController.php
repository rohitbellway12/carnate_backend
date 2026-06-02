<?php

namespace App\Livewire\Admin;

use App\Models\{City, WorkShopVendor, Country, State, Branch, Role, UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class WorkShopVendorController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches, $branch_email, $branch_number, $is_trial = 0, $trial_days = 0, $imageId, $image_id, $uploadedImageId, $uniqueId, $adminId, $gst_no, $company_name;
    public $vendorId;
    public $states = [];
    public $cities = [], $searchfilter;
    public $imageName, $imageImage, $image, $pincode;
public $is_gst = false;
    protected $listeners = ['delete'];

    // protected $rules = [


    // ];

    public function mount()
    {
        $this->branches = Branch::get();
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        $vendors = WorkShopVendor::with('cityName', 'parent');
        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $vendors->where(function ($query) use ($search) {
                $query->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$search%"]);
                $query->orWhere('email', 'LIKE', '%' . $search . '%');
                $query->orWhere('mobile_no', 'LIKE', '%' . $search . '%');
                $query->orWhereHas('parent', function ($query) use ($search) {
                    $query->whereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%$search%"]);
                });
                $query->orWhereHas('cityName', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
                $query->orWhereHas('Role', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                });
            });
        }
        $vendors = $vendors->orderBy('created_at', 'desc')
            ->where('type', 0)
            ->paginate(10);

        $countries = Country::all();

        return view('livewire.admin.work_shop_vendor', compact('vendors', 'countries'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModel()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {

        $valArr = [
            'name' => 'required|string',
            'company_name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'mobile_no' => 'required|digits:10',
            'pincode' => 'required|digits:6',
            'user_title' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ];
        if ($this->is_trial) {
            $valArr['trial_days'] = 'required|integer|min:1';
        }

        $this->validate($valArr);

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $workshopVendor = WorkShopVendor::create([
            'name' => trim($this->name),
            'company_name' => $this->company_name,
            'lastname' => trim($this->lastname),
            'user_title' => $this->user_title,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : 0,
            'mobile_no' => $this->mobile_no,
            'branch_name' => trim($this->name . ' ' . $this->lastname),
            'landline_no' => $this->landline_no,
            'country_id' => $this->country_id ?? 0,
            'state_id' => $this->state_id ?? 0,
            'city_id' => $this->city_id ?? 0,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'branch_email' => $this->email,
            'branch_number' => $this->mobile_no,
            'is_trial' => (bool) $this->is_trial, // Ensure it's stored as boolean
            'trial_days' => $this->trial_days ?? 0, // Default trial days if not provided
            'branch_logo' => $this->image_id, // Verify `$this->image_id` contains the expected value
            'gst' => $this->gst_no,
            'is_gst' => (bool) $this->is_gst,
        ]);

        $roles = Role::where('id', 19)->first();
        $workshopVendor = WorkShopVendor::find($workshopVendor->id);
        $workshopVendor->assignRole($roles->name);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Work Shop Vendor added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->isEdit = true;
        $vendor = WorkShopVendor::findOrFail($id);

        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->company_name = $vendor->company_name;
        $this->lastname = $vendor->lastname;
        $this->user_title = $vendor->user_title;
        $this->email = $vendor->email;
        $this->mobile_no = $vendor->mobile_no;
        $this->branch_name = $vendor->branch_name;
        $this->landline_no = $vendor->landline_no;
        $this->country_id = $vendor->country_id;
        $this->state_id = $vendor->state_id;
        $this->city_id = $vendor->city_id;
        $this->address = $vendor->address;
        $this->pincode = $vendor->pincode;
        $this->birth_date = $vendor->birth_date;
        $this->is_trial = $vendor->is_trial;
        $this->trial_days = $vendor->trial_days;
        $this->stateData($vendor->country_id);
        $this->cityData($vendor->state_id);
        $this->gst_no = $vendor->gst;
        $this->is_gst = $vendor->is_gst;
        $this->showModal = true;

    }

    public function update()
    {
        $valArr = [
            'name' => 'required|string',
            'company_name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'mobile_no' => 'required|digits:10',
            'pincode' => 'required|digits:6',
            'user_title' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ];

        if ($this->is_trial) {
            $valArr['trial_days'] = 'required|integer|min:1';
        }

        $this->validate($valArr);

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $vendor = WorkShopVendor::findOrFail($this->vendorId);
        $vendor->update([
            'name' => trim($this->name),
            'company_name' => $this->company_name,
            'lastname' => trim($this->lastname),
            'user_title' => $this->user_title,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'landline_no' => $this->landline_no,
            'country_id' => $this->country_id ?? 0,
            'state_id' => $this->state_id ?? 0,
            'city_id' => $this->city_id ?? 0,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'is_trial' => (bool) $this->is_trial,
            'trial_days' => $this->trial_days ?? 0,
            'gst' => $this->gst_no,
                'is_gst' => (bool) $this->is_gst,  

        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Work Shop Vendor updated successfully!']);
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

    public function trialData($trial)
    {
        $this->reset('trial_days');
    }


    #[On('imageUploaded')]
    public function handleImageUploaded($payload)
    {
        $this->uploadedImageId = $payload['imageId'];
        $this->uniqueId = $payload['uniqueId'];
        $uniq = $payload['uniqueId'];

        $this->$uniq = $this->uploadedImageId;

        if ($this->isEdit) {
            $this->editImage();
        }
    }

    public function confirmDelete($id)
    {
        $this->vendorId = $id;
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
        WorkShopVendor::destroy($this->vendorId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Work Shop Vendor deleted successfully!']);
    }


    private function resetForm()
    {
        $this->reset('name', 'company_name', 'lastname', 'user_title', 'email', 'password', 'mobile_no', 'branch_name', 'landline_no', 'country_id', 'state_id', 'city_id', 'address', 'pincode', 'birth_date', 'display_name', 'branch_email', 'branch_number', 'is_trial', 'trial_days', 'image_id', 'gst_no', 'states', 'cities', 'vendorId', 'imageName', 'image','is_gst');
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }

    public function updatedImage()
    {
        if (!empty($this->image)) {
            $this->imageName = $this->image->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->imageName,
            ]);
            $this->image = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

}
