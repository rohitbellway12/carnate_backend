<?php

namespace App\Livewire\Workshop;

use App\Models\{City, Staff, Country, State, Branch, WorkShopVendor,UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.workshop-app')]
class StaffController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $staffId,$userId,$workshopId,$role,$roles,$user,$salary,$monthly_target,$incentives,$joining_date,$showUserModal,$doucument,$file,$showViewModal,$selectedStaff;
    public $states = [];
    public $cities = [],$searchStaff,$seachRole;
    public  $imageName, $ImageData,$image;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'nullable|string',
        'mobile_no' => 'required|digits:10',
        'address' => 'required|string',
        'user_title' => 'nullable',
        'role' => 'required',
        'joining_date' => 'required',
        'salary' => 'required',
        'monthly_target' => 'nullable|numeric|min:0',
        'incentives' => 'required',
        'doucument' => 'nullable|file|max:5120',
        'image' => 'nullable|file|max:5120',
        //  'files.*' => 'file|max:5120', // Each file must be <= 5MB
    ];

    public function mount()
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->workshopId)->first();
        $this->branches = Branch::get();
        $this->roles = Role::whereNot('name','WorkshopVendor')->where('guard_name','web')->get();
        $this->imageName = '';
        $this->ImageData = '';
    }

    public function render()
    {
             $items = WorkShopVendor::with('cityName', 'Role')
            ->whereNot('user_type', 0)
            ->where('parent_id', $this->workshopId);

            if ($this->searchStaff) {
                $items = $items->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->searchStaff . '%')
                        ->orWhere('email', 'like', '%' . $this->searchStaff . '%')
                        ->orWhere('mobile_no', 'like', '%' . $this->searchStaff . '%');
                });
            }

            if ($this->seachRole) {
                // $items = $items->where(function ($query) {
                    $items = $items->whereHas('Role', function ($query) {
                        $query->where('id',$this->seachRole);
                    });
                // });
            }

            $items = $items->orderBy('created_at', 'desc')
                ->paginate(10);

             return view('livewire.workshop.staff', compact('items'));
    }

    public function create()
    {
        $this->resetForm();
        $this->resetErrorBag();
        $this->isEdit = false;
        $this->showModal = true;
    }
       public function addUser($id)
    {

        $this->userId = $id;
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = false;
        $this->showUserModal = true;
    }

    public function store()
    {


        $this->validate();
        $imagePath = '';
        //  if ($this->doucument) {
        //     $imagePath = $this->doucument->store('uploads', 'public');
        // }

         if (!empty($this->image)) {
            $imagePath = $this->ImageData->file;
        }

      $staff =  WorkShopVendor::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title ?? 'mr',
            // 'email' => $this->email,
            // 'password' => $this->password ? bcrypt($this->password) : null,
            'mobile_no' => $this->mobile_no,
            'address' => $this->address,
            'user_type' => $this->role,
            'salary' => $this->salary,
            'monthly_target' => $this->monthly_target,
            'incentives' => $this->incentives,
            'joining_date' => $this->joining_date,
            'parent_id' => $this->workshopId,
            'file' => $imagePath,
        ]);

        $roles = Role::where('id', $this->role)->first();
        $staff = WorkShopVendor::find($staff->id);
        $staff->assignRole($roles->name);

        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Staff added successfully!']);
        $this->resetForm();
        $this->resetErrorBag();
        $this->showModal = false;
    }


    public function storeUser()
    {

        $valArr = [
           'email'=>'required',
           'password'=>'required',
        ];


        $this->validate($valArr);

        // testvishsupervisor@gmail.com
        $staff =   WorkShopVendor::where('id',$this->userId)->first();

        // echo "<pre>";print_r($staff);die;
        $staff->email = $this->email;
        $staff->password = $this->password ? bcrypt($this->password) : null;
        $staff->is_user = 1;
        $staff->save();



        $this->dispatch('swal:toast', ['type' => 'success','message' => 'User Created successfully!']);
        $this->resetForm();
        $this->showUserModal = false;
    }

    public function viewStaff($id)
    {
        $this->selectedStaff = WorkShopVendor::with('cityName', 'Role')->findOrFail($id);
        $this->showViewModal = true;
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->isEdit = true;
        $staff = WorkShopVendor::findOrFail($id);

        $this->staffId = $staff->id;
        $this->name = $staff->name;
        $this->lastname = $staff->lastname;
        $this->user_title = $staff->user_title;
        $this->mobile_no = $staff->mobile_no;
        $this->address = $staff->address;
        $this->role = $staff->user_type;
        $this->salary = $staff->salary;
        $this->monthly_target = $staff->monthly_target;
        $this->incentives = $staff->incentives;
        $this->joining_date = $staff->joining_date;
        $this->imageName = $staff->file;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $staff = WorkShopVendor::findOrFail($this->staffId);

        // Determine image path: use new upload, or keep existing
        if (!empty($this->image) && !empty($this->ImageData)) {
            $imagePath = $this->ImageData->file;
        } else {
            $imagePath = $staff->file; // preserve existing image
        }

        $staff->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'user_title' => $this->user_title,
            'mobile_no' => $this->mobile_no,
            'address' => $this->address,
            'user_type' => $this->role,
            'salary' => $this->salary,
            'monthly_target' => $this->monthly_target,
            'incentives' => $this->incentives,
            'joining_date' => $this->joining_date,
            'parent_id' => $this->workshopId,
            'file' => $imagePath,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Staff updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }



    public function confirmDelete($id)
    {
        $this->staffId = $id;

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
        WorkShopVendor::destroy($this->staffId);
        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->name = '';
        $this->doucument = '';
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
        $this->role = '';
        $this->staffId = null;
        $this->states = [];
        $this->cities = [];
        $this->image = '';
        $this->imageName = null;

        $this->joining_date = '';
        $this->salary = '';
        $this->monthly_target = '';
        $this->incentives = '';
    }

    public function resetFilter(){
        $this->searchStaff="";
        $this->seachRole="";
    }

    public function updatedImage()
    {
        if (!empty($this->image)) {
            $this->imageName = $this->image->store("driver", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->imageName,
            ]);
            $this->ImageData = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image is uploaded',]);
    }

public function toggleLogin($id)
{
    $staff = WorkShopVendor::findOrFail($id);
    $staff->is_login = !$staff->is_login; // Toggle login state
    $staff->save();

    // Dispatch SweetAlert toast event to frontend
    $this->dispatch('swal:toast', [
        'type' => 'success',
        'message' => ' status updated successfully!',
    ]);
}

}
