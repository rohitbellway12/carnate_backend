<?php

namespace App\Livewire\Sparepart;

use App\Models\{Branch, City, Country, SparePartVendor, State, UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $currectUser;
    public $vendorId;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches, $imageId, $image_id, $uploadedImageId, $uniqueId, $type, $editId, $adminId, $gst_no, $pincode, $is_gst;
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $imageImage, $isEdit = false;
    public $imageName, $image, $branchLogoName;
    public $signImage, $signImageName, $tagline;
    public $company_name, $company_email, $company_number;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'user_title' => 'required',
        'birth_date' => 'nullable',
        'company_name' => 'required',
        'company_email' => 'required|email',
        'company_number' => 'required|digits:10',
        'pincode' => 'required|integer|digits:6',
        'image' => 'required',
        'signImage' => 'required',
    ];

    public function mount()
    {
        $vendor = Auth::guard('sparepart')->user();
        $this->branches = Branch::get();
        $this->countries = Country::all();
        $this->isEdit = true;
        $this->currectUser = $vendor;

        $this->image = $vendor?->profileImage;
        $this->signImage = $vendor?->SignImage;

        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->lastname = $vendor->lastname;
        $this->user_title = $vendor->user_title;
        $this->email = $vendor->email;
        $this->mobile_no = $vendor->mobile_no;
        $this->landline_no = $vendor->landline_no;
        $this->country_id = $vendor->country_id;
        $this->state_id = $vendor->state_id;
        $this->city_id = $vendor->city_id;
        $this->address = $vendor->address;
        $this->birth_date = $vendor->birth_date;
        $this->display_name = $vendor->display_name;
        $this->image_id = $vendor->image;
        $this->gst_no = $vendor->gst_number;
        $this->pincode = $vendor->pincode;
        $this->is_gst = $vendor->is_gst;
        $this->company_number = $vendor->branch_number;
        $this->company_email = $vendor->branch_email;
        $this->company_name = $vendor->company_name ?? $vendor->branch_name;

        $this->stateData($vendor->country_id);
        $this->cityData($vendor->state_id);
    }

    #[Layout('components.layouts.spare-part-app')]
    public function render()
    {
        return view('livewire.sparepart.profile');
    }

    public function stateData($countryId, $change = false)
    {
        if ($countryId) {
            $this->states = State::where('country_id', $countryId)->get();
        } else {
            $this->states = [];
        }
        if ($change) {
            $this->reset('state_id', 'city_id', 'cities');
        }
    }

    public function cityData($stateId, $change = false)
    {
        if ($stateId) {
            $this->cities = City::where('state_id', $stateId)->get();
        } else {
            $this->cities = [];
        }

        if ($change) {
            $this->reset('city_id');
        }
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

        // dd($this->image);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

    public function updatedSignImage()
    {
        if (!empty($this->signImage)) {
            $this->signImageName = $this->signImage->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->signImageName,
            ]);
            $this->signImage = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->validate();


        $vendor = SparePartVendor::findOrFail($this->vendorId);
        $vendor->update([
            'name' => $this->name,
            'company_name' => $this->company_name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'branch_name' => $this->company_name,
            'landline_no' => $this->landline_no,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'address' => $this->address,
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'gst_number' => $this->gst_no,
            'pincode' => $this->pincode,
            'branch_logo' => $this->image->id ?? 0,
            'branch_sign_logo' => $this->signImage->id ?? 0,
            'branch_email' => $this->company_email,
            'branch_number' => $this->company_number,
            'is_gst' => $this->is_gst,
            'profile_update' => 1,

        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Spare Part Vendor updated successfully!']);
    }
}
