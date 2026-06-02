<?php

namespace App\Livewire\Workshop;
use App\Models\Vehicle;
use Livewire\WithFileUploads;
use App\Models\{City, WorkShopVendor, Country, State, Branch , Customer, JobCard, JobCardsInspection, User};
use App\Models\JobCardsDentMark;
use App\Models\UploadImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  

class JobCartAddController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches;
    public $staffId,$workshopId;
    public $states = [];
    public $cities = [];
    public $customers,$supervisors,$country,$vehical_type,$vehical_brand,$fuel_type,$color,$model_name;
    public $showCustomerVoice,$addCustomerVoice,$confirmpassword,$add,$smsAlert,$showPhoto,$addphoto,$accessories
    ,$showAccessoriesVoice,$addAccessoriesVoice,$addWorkNote,$showWorkNote,$images,$addVehicals,$isAddvehicle,$customer_name,$fual_level,$supervisor,$vehiclesName;      
    public $customerVoices = [];
    public $accessoriesVoices = [];
    public $workVoices = [];
    public $vehicles = [];
    public $km_reading = 0;
    public $isAdd = false;

    public $customerVoiceCount = "0";
    public $jobcarddentCount = "0";
    public $photosCount = "0";
    public $accessariesCount = "0";
    public $workNoteCount = "0";
    public $showDentCar = false;
    public $jobcardNumbers;
    public $jobCardsDentImage;
    public $adds = false;

    public $isVehical,$showVehical,$isBrand,$showBrand,$isModel
    ,$showModel,$isFuel,$showFuel,$vehicleDetails;
    public $vehicle_id ,$vehicleBrand,$modelName,$fuel_id,$odometerReading,$numberPlate,$chassisNo,$modelYear,$noOfGear;
    public $dateOfManufacturing,$gearbox,$gearboxNo,$engineN,$engineSize,$engine,$keyNo,$engineNo;
    public $isEdits = false;
    public $fields = [];
    public $vehicleType = '';
    public $vehicleTypes = [];
    public $brandType = '';
    public $brandTypes = [];
    public $modelType = '';
    public $modelTypes = [];
    public $fuelType = '';
    public $fuelTypes = [];

    protected $listeners = ['delete','showModal', 'deleteDentImage','saveImage'];

    protected $rules = [
        'name' => 'required|string',
        // 'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'branch_name' => 'required|string',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'gender' => 'required',
    ];

    public function mount($isAdd=null)
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->branches = Branch::get();
       
        $this->customerVoices = !empty($jobCardsInspection) 
        ? collect($jobCardsInspection)->pluck('customer_voice')->toArray() 
        : [''];
        $this->accessoriesVoices = !empty($jobCardsInspection) 
        ? collect($jobCardsInspection)->pluck('ccessorie_voice')->toArray() 
        : [''];
        $this->workVoices = !empty($jobCardsInspection) 
        ? collect($jobCardsInspection)->pluck('work_voice')->toArray() 
        : [''];
        
        $this->jobcardNumbers = generateHashJobCardNumber(Auth::guard('workshop')->user());
    }

    public function render()
    {
        $this->customers = Customer::get();

        $this->supervisors = WorkShopVendor::where('type', 2)->get();
        $countries = Country::all();

        return view('livewire.workshop.jobcart.add', compact('countries'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
       
        $this->supervisors = WorkShopVendor::where('type', 2)->get();
        
    }

    public function addCustomer()
    {
        $this->add = false;
        $this->showModal = true;
    }
    
    public function addVehical()
    {
        $this->isEdits = false;
        $this->vehicleDetails = true;
    }
  

    public function addAccessorie()
    {
        
        $this->addAccessoriesVoice = false;
        $this->showAccessoriesVoice = true;
        
    }

    public function addWork()
    {
        
        $this->addWorkNote = false;
        $this->showWorkNote = true;
        
    }

    public function addVoice()
    {
        
        $this->addCustomerVoice = false;
        $this->showCustomerVoice = true;
        
    }

    public function addImage()
    {
        
        $this->addphoto = false;
        $this->showPhoto  = true;
        
    }

    public function addWorkField()
    {
        $this->workVoices[] = '';
    }

    public function removeWorkField($index)
    {
        unset($this->workVoices[$index]);
        $this->workVoices = array_values($this->workVoices); // Reindex array
    }

    public function addAccessorieField()
    {
        $this->accessoriesVoices[] = '';
    }

    public function removeAccessorieField($index)
    {
        unset($this->accessoriesVoices[$index]);
        $this->accessoriesVoices = array_values($this->accessoriesVoices); // Reindex array
    }

    public function addField()
    { 
        $this->customerVoices[] = '';
    }

    public function removeField($index)
    {
        unset($this->customerVoices[$index]);
        $this->customerVoices = array_values($this->customerVoices); // Reindex array
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
        // $this->validate();
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

    public function vehicleData($customerId)
    {  
        if ($customerId) {
            $this->vehicles = Vehicle::where('customer_id', $customerId)->get();
        } else {
            $this->vehicles = [];
        }

        // echo "<pre>";print_r($this->vehicles);die;
    }


    public function storeCustomer()
    {
        $valArr = [
            'name' => ["required"],      
            // 'lastname' => ["required"],   
            'mobile_no' => ["required","min:10"],
            // 'gender' => ["required"],      
            'email' => ["required"],      
            'password' => ["required"],      
            'address' => ["required"],      
            'country_id' => ["required"],      
            'state_id' => ["required"],      
            'city_id' => ["required"],      
            // 'birth_date' => ["required"],      
        ];
    
        $this->validate($valArr);

        

        // Format DOB based on date format
      
        // Create Customer
        $customer = new Customer();
        $customer->name = $this->name;
        $customer->lastname = $this->lastname; 
        $customer->gender = $this->gender;
        $customer->birth_date = date('Y-m-d', strtotime($this->birth_date));
        $customer->email = $this->email;
        $customer->password = Hash::make($this->password);
        $customer->mobile_no = $this->mobile_no; 
        $customer->address = $this->address;
        $customer->country_id = $this->country_id;
        $customer->state_id = $this->state_id;
        $customer->city_id = $this->city_id;  
        $customer->save();
        // Return a response

        
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer added successfully!',
        ]); 
         
        $this->showModal = false;
    }

    public function customerVoice()
    {
 
   
         $valArr = [
            'customerVoices.*' => ["required"],      
        ];
    
        
        $customMessages = customErrorMsg();
        $this->validate($valArr,$customMessages);
        

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->delete();
     
          
        foreach ($this->customerVoices as $voice) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $voice,
                'is_customer_voice' => 1,
            ]);
        }
     
        $cardInspirationCount = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 1)
            ->count();
     
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Customer Voice Added Successfully!',
        ]);
    
        $this->customerVoiceCount =$cardInspirationCount;
        
        $this->showCustomerVoice = false;
    }
    
    public function addphoto()
    { 
        // Validate the images
        $this->validate([
            'images.*' => 'image|max:1024', // Validate each image (max size 1MB)
        ]);

        // Process and store each image
        foreach ($this->images as $image) {
            $image->store('images', 'public'); // Store in 'storage/app/public/images'
        }

        // Success message
        session()->flash('success', 'Images uploaded successfully!');

        // Reset inputs and close modal
        $this->reset(['images', 'showPhoto']);
    }

    
    public function accessoriesVoice()
    {
             
        $valArr = [
            'accessoriesVoices.*' => ["required"],      
        ];
    
        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
        ->where('is_customer_voice', 2)
        ->delete();

        $customMessages = customErrorMsg();
        $this->validate($valArr,$customMessages);

        foreach ($this->accessoriesVoices as $accessaries) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $accessaries,
                'is_customer_voice' => 2,
            ]);
        }
     
        $cardInspirationCountAccessaries = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 2)
            ->count();
     
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Accessories Added Successfully!',
        ]);

        $this->accessariesCount =$cardInspirationCountAccessaries;

        $this->showAccessoriesVoice = false;
    }
    public function workVoice()
    {
        $valArr = [
            'workVoices.*' => ["required"],      
        ];
     
        $customMessages = customErrorMsg();
        $this->validate($valArr,$customMessages);

        JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
        ->where('is_customer_voice', 0)
        ->delete();

        foreach ($this->workVoices as $vorknote) {
            JobCardsInspection::create([
                'jobcard_number' => $this->jobcardNumbers,
                'customer_voice' => $vorknote,
                'is_customer_voice' => 0,
            ]);
        }
     
        $cardInspirationCountWorkNotes = JobCardsInspection::where('jobcard_number', $this->jobcardNumbers)
            ->where('is_customer_voice', 0)
            ->count();
     
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Work Notes Added Successfully!',
        ]);

        $this->workNoteCount =$cardInspirationCountWorkNotes;

        $this->showWorkNote = false;
    }

  

    public function showDent()
    {

    
        $this->showDentCar = true; 
        // Get the dent image for this jobcard number (replace with your logic)
        // $this->jobCardsDentImagejobCardsDentImage = '';
    
    $this->dispatch('show-dent-modal');
    
}
public function saveImage($mergedImageData)
{   
    $imageData = str_replace('data:image/png;base64,', '', $mergedImageData);
    $imageData = str_replace(' ', '+', $imageData); 
    $image = base64_decode($imageData);  
    $fileName = 'marked_car_' . Str::random(10) . '.png';
 
    $path = public_path('uploads/' . $fileName);
 
    file_put_contents($path, $image);
 
    $carImage = new UploadImage();
    $carImage->file = 'uploads/' . $fileName;   
    $carImage->img_id = 0;
    $carImage->save();
 
    $jobCardsDentMark = new JobCardsDentMark();
    $jobCardsDentMark->jobcard_number = $this->jobcardNumbers;
    $jobCardsDentMark->file_id = $carImage->id;
    $jobCardsDentMark->save();
 
    $cardInspirationCountDent = JobCardsDentMark::where('jobcard_number', $this->jobcardNumbers) 
    ->count();

    $this->jobcarddentCount =$cardInspirationCountDent;


    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => 'Dent Car Added Successfully!',
    ]);
 
    $this->showDentCar = false; 
}

public function closeModal()
{
$this->resetPage();
$this->showDentCar = false;
$this->dispatch('show-dent-modal');

}

    public function createJobCard()
    {
             
        $valArr = [
            'customer_name' => "required",      
            'vehicle_id' => "required",      
            'km_reading' => "nullable|min:0",         
            
        ];
    
        $this->validate($valArr);

        
        $customer = Customer::with(['vehicles' => function ($query) {
            $query->where('id', $this->vehicle_id);
        }])->find($this->customer_name);
 
        // echo "<pre>";print_r($customer->toArray());die;
        $jobcard = new JobCard();
        $jobcard->jobcard_number = $this->jobcardNumbers;
        
        $jobcard->customer_id = $this->customer_name;
        $jobcard->customer_name = strtoupper($customer->name . ' ' . $customer->lastname);
        $jobcard->vehicle_id = $this->vehicle_id ?? 0;
        $jobcard->vehical = @$customer->vehicles->first()->modelname ?? 0;
        $jobcard->vehical_number = @$customer->vehicles->first()->number_plate ?? 0;
        $jobcard->entry_date = Carbon::now();
        $jobcard->amount = $this->total_amount ?? 0;
        $jobcard->discount = $this->total_discount ?? 0;
        $jobcard->final_amount = $this->final_amount ?? 0;
        $jobcard->advance = $this->advance ?? 0;
        $jobcard->balance_amount = $this->balance_amount ?? 0;
        $jobcard->km_runing = $this->km_reading ?? 0;
        $jobcard->fual_level = $this->fual_level ?? 0;
        $jobcard->supervisor_id = $this->supervisor ?? 0;
        $jobcard->sms_alert = $this->sms_alert ?? 0;
        $jobcard->delivery_date = $this->delivery_date ??  Carbon::now();
        $jobcard->delivery_time = $this->delivery_time ??  Carbon::now();
        $jobcard->user_id =  Auth::guard('workshop')->user()->id;
        $jobcard->save();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Job-Card Added Successfully!',
        ]);

        return redirect()->route('workshop.jobcart');

    }

    // public function deleteDentImage($dentimageId, $imageId)
    // {
    //     // Logic for deleting the image from the database and storage
    //     $dentImage = DentImage::find($dentimageId);
    //     if ($dentImage) {
    //         // Delete the image file
    //         Storage::delete($dentImage->image_path); // Adjust the storage path accordingly
    //         $dentImage->delete();
    //     }
    //     $this->emit('imageDeleted');
    // }

    // public function saveMarkedImage($imageData, $jobcardNo)
    // {
    //     // Logic for saving the marked image (this can be saving to DB or storage)
    //     $imageName = 'marked_image_' . time() . '.png';
    //     $imagePath = 'public/marked_images/' . $imageName;
        
    //     // Save the image to storage
    //     Storage::put($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));

    //     // You can store the image path in your database or associate it with the Job-Card
    //     // Example:
    //     DentImage::create([
    //         'jobcard_no' => $jobcardNo,
    //         'image_path' => $imagePath
    //     ]);

    //     // Emit success message
    //     $this->emit('imageSaved');
    // }
    

    public function store()
    { 
        // $this->validate();

        // WorkShopVendor::create([
        //     'name' => $this->name,
        //     'lastname' => $this->lastname,
        //     'gender' => $this->gender,
        //     'email' => $this->email,
        //     'password' => $this->password ? bcrypt($this->password) : null,
        //     'mobile_no' => $this->mobile_no,
        //     'branch_name' => $this->branch_name,
        //     'landline_no' => $this->landline_no,
        //     'country_id' => $this->country_id,
        //     'state_id' => $this->state_id,
        //     'city_id' => $this->city_id,
        //     'address' => $this->address,
        //     'birth_date' => $this->birth_date,
        //     'display_name' => $this->display_name,
        //     'type' => 2,
        //     'parent_id' => $this->workshopId,
        // ]);

        // $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff added successfully!']);
        // $this->resetForm();
        // $this->showModal = false;
    }

    public function edit($id)
    {
        // echo "<pre>";print_r($id);die;
        // $this->isEdit = true;
        // $staff = WorkShopVendor::findOrFail($id);

        // $this->staffId = $staff->id;
        // $this->name = $staff->name;
        // $this->lastname = $staff->lastname;
        // $this->gender = $staff->gender;
        // $this->email = $staff->email;
        // $this->mobile_no = $staff->mobile_no;
        // $this->branch_name = $staff->branch_name;
        // $this->landline_no = $staff->landline_no;
        // $this->country_id = $staff->country_id;
        // $this->state_id = $staff->state_id;
        // $this->city_id = $staff->city_id;
        // $this->address = $staff->address;
        // $this->birth_date = $staff->birth_date;
        // $this->display_name = $staff->display_name;

        // $this->stateData($staff->country_id); // Load states based on the country
        // $this->cityData($staff->state_id);   // Load cities based on the state

        // $this->showModal = true;
    }

    public function update()
    {
    //     $this->validate();

    //     $staff = WorkShopVendor::findOrFail($this->staffId);
    //     $staff->update([
    //         'name' => $this->name,
    //         'lastname' => $this->lastname,
    //         'gender' => $this->gender,
    //         'email' => $this->email,
    //         'mobile_no' => $this->mobile_no,
    //         'branch_name' => $this->branch_name,
    //         'landline_no' => $this->landline_no,
    //         'country_id' => $this->country_id,
    //         'state_id' => $this->state_id,
    //         'city_id' => $this->city_id,
    //         'address' => $this->address,
    //         'birth_date' => $this->birth_date,
    //         'display_name' => $this->display_name,
    //         'parent_id' => $this->workshopId,
    //     ]);

    //     $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff updated successfully!']);
    //     $this->resetForm();
    //     $this->showModal = false;
    }

   
    public function delete()
    {
        WorkShopVendor::destroy($this->staffId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->gender = '';
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
        $this->staffId = null;
        $this->states = [];
        $this->cities = [];
    }
}
