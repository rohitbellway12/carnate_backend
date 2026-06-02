<?php

namespace App\Livewire\Admin;

use App\Models\{City, SparePartVendor, Country, State,Role, Branch, UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class SparePartVendorController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches,$imageId,$image_id,$uploadedImageId,$uniqueId,$type,$editId,$adminId,$company_name;
    public $vendorId;
    public $states = [];
    public $cities = [],$searchfilter,$gst_no,$pincode;
    public $imageName, $imageImage,$image;
    public $is_gst = false;
    public $selectedVendors = [];
    public $selectAll = false;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'company_name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'pincode' => 'required|digits:6',
        'user_title' => 'required',
    ];

    public function mount()
    {
        $this->branches = Branch::get();
        $this->adminId = Auth::guard('admin')->user()->id;

        $this->imageName = '';
        $this->imageImage = '';
    }

    public function render()
    {
        $vendors = SparePartVendor::with('cityName')
            ->orderBy('created_at', 'desc');
        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $vendors = $vendors->whereRaw("CONCAT(name, '', lastname) LIKE ?", ["%$search%"]);
        }
            $vendors=$vendors->paginate(10);


        $countries = Country::all();

        return view('livewire.admin.spare_part_vendor', compact('vendors', 'countries'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function store()
    {
        // $this->validate();
        
        $rules = $this->rules;


        if (!$this->password) {
            $rules['password'] = 'required';
        }
        
        $this->validate($rules);

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        // echo "<pre>";print_r($create);die;
        $sparePartVendor= SparePartVendor::create([
            'name' => $this->name,
            'company_name' => $this->company_name,
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
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'image' => $this->image_id,
            'gst_number' => $this->gst_no,
              'is_gst' => (bool) $this->is_gst,
        ]);
        
        $roles = Role::where('name', 'Spare-Part-Admin')->where('guard_name','sparepart')->first();
        $workshopVendor = SparePartVendor::find($sparePartVendor->id);
        $workshopVendor->assignRole($roles->name);
        
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Spare Part Vendor added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function changeStatus($id)
    {
        $vendor = SparePartVendor::findOrFail($id);
        $vendor->status = !$vendor->status;
        $vendor->save();
        
        $message = $vendor->status ? 'Vendor activated successfully!' : 'Vendor deactivated successfully!';
        
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => $message]);
    }

    public function changeOnlineStockStatus($id)
    {
        $vendor = SparePartVendor::findOrFail($id);
        $vendor->online_stock_status = !$vendor->online_stock_status;
        $vendor->save();
        
        $message = $vendor->online_stock_status ? 'Online stock status activated!' : 'Online stock status deactivated!';
        
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => $message]);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedVendors = SparePartVendor::pluck('id')->map(fn($id) => (string)$id)->toArray();
        } else {
            $this->selectedVendors = [];
        }
    }

    public function bulkActivate()
    {
        if (empty($this->selectedVendors)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please select at least one vendor.']);
            return;
        }

        SparePartVendor::whereIn('id', $this->selectedVendors)->update(['status' => 1]);
        $this->selectedVendors = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Selected vendors activated successfully!']);
    }

    public function bulkDeactivate()
    {
        if (empty($this->selectedVendors)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please select at least one vendor.']);
            return;
        }

        SparePartVendor::whereIn('id', $this->selectedVendors)->update(['status' => 0]);
        $this->selectedVendors = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Selected vendors deactivated successfully!']);
    }

    public function bulkActivateOnlineStock()
    {
        if (empty($this->selectedVendors)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please select at least one vendor.']);
            return;
        }

        SparePartVendor::whereIn('id', $this->selectedVendors)->update(['online_stock_status' => 1]);
        $this->selectedVendors = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Selected vendors online stock status activated!']);
    }

    public function bulkDeactivateOnlineStock()
    {
        if (empty($this->selectedVendors)) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please select at least one vendor.']);
            return;
        }

        SparePartVendor::whereIn('id', $this->selectedVendors)->update(['online_stock_status' => 0]);
        $this->selectedVendors = [];
        $this->selectAll = false;
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Selected vendors online stock status deactivated!']);
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $vendor = SparePartVendor::findOrFail($id);


        
        $image = UploadImage::find($vendor->image);

        // echo "<prE>";print_r(public_path($image->file));die;


        $this->imageImage = @$image->file;


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
        $this->display_name = $vendor->display_name;
        $this->gst_no = $vendor->gst_number;
          $this->is_gst = $vendor->is_gst;
        $this->stateData($vendor->country_id); // Load states based on the country
        $this->cityData($vendor->state_id);   // Load cities based on the state

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $vendor = SparePartVendor::findOrFail($this->vendorId);
        $vendor->update([
            'name' => $this->name,
            'company_name' => $this->company_name,
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
            'pincode' => $this->pincode,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'gst_number' => $this->gst_no,
               'is_gst' => (bool) $this->is_gst,  
            'image' => $this->image_id,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Spare Part Vendor updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }
    
    public function closeModel(){
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    
    #[On('imageUploaded')]
    public function handleImageUploaded($payload)
    {
        $this->uploadedImageId = $payload['imageId'];
        $this->uniqueId = $payload['uniqueId'];
        $uniq = $payload['uniqueId'];

        $this->$uniq = $this->uploadedImageId;

        if($this->isEdit){
            $this->editImage();
        }
    }

    public function editImage()
    {
        $sparePartVendorId = SparePartVendor::where('id', $this->editId)->first();
        $sparePartVendorId->update([
            'image' => $this->image_id ?? 0, 
        ]);
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
        SparePartVendor::destroy($this->vendorId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Spare Part Vendor deleted successfully!']);
    }

    private function resetForm()
    {
        $this->reset('name','company_name','lastname','user_title','email','password','mobile_no','branch_name','landline_no','country_id','state_id','city_id','address','pincode','birth_date','display_name','image_id','gst_no','vendorId','states','cities','image','is_gst');
    }
    
     public function resetFilter(){
        $this->searchfilter ='';
    }
    
    public function updatedSearchfilter(){
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
