<?php

namespace App\Livewire\Workshop;

use App\Models\{City, WorkShopVendor, Country, State, Branch, UploadImage};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.workshop-app')]
class ProfileController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $user_title = 'mr', $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $birth_date, $display_name, $branches, $branch_email, $branch_number, $imageId, $image_id, $uploadedImageId, $uniqueId, $workshopId, $editImage, $gst, $pincode, $company_name, $is_gst = 0;
    public $vendorId;
    public $countries = [], $states = [], $cities = [];
    public $signLogoId;
    public $imageName, $image, $branchLogoName;
    public $signImage, $signImageName, $tagline;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'company_name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'mobile_no' => 'required|digits:10',
        'user_title' => 'required',
        'branch_email' => 'required',
        'branch_number' => 'required',
        'branch_name' => 'required',
        'country_id' => 'required',
        'tagline' => 'nullable|string',
        'state_id' => 'required',
        'city_id' => 'required',
        'pincode' => 'required|integer|digits:6',
        'is_gst' => 'required|boolean',
        'image' => 'required',
        'signImage' => 'required',
    ];
    protected function messages()
    {
        return [
            'branch_email.required' => 'The company email field is required.',
            'branch_number.required' => 'The company number field is required.',
            'branch_name.required' => 'The company name field is required.',
            'country_id.required' => 'The country field is required.',
            'state_id.required' => 'The state name field is required.',
            'city_id.required' => 'The city name field is required.',
            'image.required' => 'The company logo image field is required.',
            'signImage.required' => 'The company sign image field is required.',
        ];
    }

    public function mount()
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->isEdit = "Edit";
        $this->branches = Branch::get();


        $id = $this->workshopId;

        $this->isEdit = true;
        $vendor = WorkShopVendor::findOrFail($id);

        $image = UploadImage::find($vendor->branch_logo);

        // echo "<prE>";print_r(public_path($image->file));die;


        $this->imageId = $image?->file;

        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->company_name = $vendor->company_name;
        $this->lastname = $vendor->lastname;
        $this->user_title = $vendor->user_title ?? 'mr';
        $this->email = $vendor->email;
        $this->mobile_no = $vendor->mobile_no;
        $this->branch_name = $vendor->branch_name;
        $this->landline_no = $vendor->landline_no;
        $this->country_id = $vendor->country_id;
        $this->state_id = $vendor->state_id;
        $this->city_id = $vendor->city_id;
        $this->address = $vendor->address;
        $this->birth_date = $vendor->birth_date;
        $this->display_name = $vendor->display_name;
        $this->branch_email = $vendor->branch_email;
        $this->branch_number = $vendor->branch_number;
        $this->gst = $vendor->gst;
        $this->is_gst = $vendor->is_gst;
        $this->pincode = $vendor->pincode;

        $this->stateData($vendor->country_id); // Load states based on the country
        $this->cityData($vendor->state_id);   // Load cities based on the state

        // echo "<pre>";print_r($this->workshopId);die;

        $this->countries = Country::all();

        $imageSing = UploadImage::find($vendor->branch_sign_logo);
        $this->image = $image;
        $this->signImage = $imageSing;
        $this->tagline = $vendor->tagline;

    }

    public function render()
    {


        return view('livewire.workshop.profile');
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

        $vendor = WorkShopVendor::findOrFail($this->vendorId);



        if ($vendor->is_trial == 0) {
            $trial_start_date = null;
        } else {
            $trial_start_date = date('Y-m-d');
        }
        ;

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
            'birth_date' => $this->birth_date,
            'display_name' => $this->display_name,
            'branch_email' => $this->branch_email,
            'branch_number' => $this->branch_number,
            'pincode' => $this->pincode,
            'profile_update' => 1,
            'gst' => $this->gst,
            'is_gst' => $this->is_gst,
            'trial_start_date' => $trial_start_date,
            'branch_logo' => $this->image?->id ?? 0,
            'branch_sign_logo' => $this->signImage?->id ?? 0,
            'tagline' => $this->tagline,

        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Work Shop Vendor updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
        return redirect()->route('workshop.profile');


    }

    public function stateData($countryId, $change = false)
    {
        if ($countryId) {
            $this->states = State::where('country_id', $countryId)->get();
        } else {
            $this->states = [];
        }
        if ($change) {
            $this->reset('state_id', 'cities', 'city_id');
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


    public function editImage()
    {
        $sparePartVendorId = WorkShopVendor::where('id', $this->vendorId)->first();
        $sparePartVendorId->update([
            'branch_logo' => $this->image_id ?? 0,
        ]);
    }


    private function resetForm()
    {
        $this->name = '';
        $this->company_name = '';
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
        $this->vendorId = null;
        $this->states = [];
        $this->cities = [];
        $this->pincode = [];
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
}
