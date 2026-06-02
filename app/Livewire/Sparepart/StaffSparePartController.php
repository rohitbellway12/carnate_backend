<?php

namespace App\Livewire\Sparepart;

use App\Models\{City, Staff, Country, State, Branch, SparePartVendor, UploadImage, WorkShopVendor};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;

class StaffSparePartController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $user_title = 'mr', $birth_date, $display_name, $branches;
    public $staffId, $userId, $sparepartId, $role, $roles, $user, $salary, $monthly_target, $incentives, $joining_date, $showUserModal,$oldDocument,$image_id;
    public $states = [];
    public $cities = [], $document, $searchfilter;

    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'mobile_no' => 'required|digits:10',
        'address' => 'required|string',
        'user_title' => 'required',
        'role' => 'required',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->user = SparePartVendor::where('id', $this->sparepartId)->first();
        $this->branches = Branch::get();
        $this->roles = Role::where('guard_name', 'sparepart')->get();
        $this->user_title = 'mr';
    }
    #[Layout('components.layouts.spare-part-app')]
    public function render()
    {
        $items = SparePartVendor::with('cityName','profileImage')
            ->whereNot('user_type', 0)
            ->where('parent_id', $this->sparepartId);
        if ($this->searchfilter) {
            $items = $items->where('name', 'like', '%' . $this->searchfilter . '%')
                ->Orwhere('lastname', 'like', '%' . $this->searchfilter . '%')
                ->Orwhere('email', 'like', '%' . $this->searchfilter . '%')
                ->Orwhere('mobile_no', 'like', '%' . $this->searchfilter . '%');
        }
        $items = $items->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.sparepart.staff', compact('items'));
    }

    public function create()
    {
        $this->resetForm();
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

    public function save()
    {
        try {
            $this->validate();

            if (!empty($this->document) && is_object($this->document) && method_exists($this->document, 'store')) {
                $imageName = $this->document->store("uploads", "public_root");
                $uploadid = UploadImage::create([
                    "file" => $imageName,
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);
                $this->image_id = $uploadid->id;
            }

            $data = [
                'name' => $this->name,
                'lastname' => $this->lastname,
                'user_title' => $this->user_title,
                'email' => $this->email ?? '',
                'mobile_no' => $this->mobile_no,
                'address' => $this->address,
                'user_type' => $this->role,
                'salary' => $this->salary ?? '0',
                'incentives' => $this->incentives ?? '0',
                'joining_date' => $this->joining_date ?? '',
                'parent_id' => $this->sparepartId,
                'image' => (string)$this->image_id,
                'branch_logo' => $this->image_id,
                'status' => '1',
            ];

            if ($this->isEdit) {
                $staff = SparePartVendor::findOrFail($this->staffId);
                $staff->update($data);
                $msg = 'Staff updated successfully!';
            } else {
                $data['password'] = $this->password ? bcrypt($this->password) : '';
                $staff = SparePartVendor::create($data);
                $msg = 'Staff added successfully!';
            }

            $roles = Role::where('id', $this->role)->first();
            if ($roles) {
                $staff->syncRoles([$roles->name]);
            }

            $this->dispatch('swal:toast', ['type' => 'success', 'message' => $msg]);
            $this->resetForm();
            $this->showModal = false;
        } catch (\Exception $e) {
             $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
             throw $e;
        }
    }


    public function storeUser()
    {

        $valArr = [
            'email' => 'required',
            'password' => 'required',
        ];

        $this->validate($valArr);

        // testvishsupervisor@gmail.com
        $staff = SparePartVendor::where('id', $this->userId)->first();

        // echo "<pre>";print_r($staff);die;
        $staff->email = $this->email;
        $staff->password = $this->password ? bcrypt($this->password) : null;
        $staff->is_user = 1;
        $staff->save();



        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'User Created successfully!']);
        $this->resetForm();
        $this->showUserModal = false;
    }
    public function edit($id)
    {
        $this->isEdit = true;
        $staff = SparePartVendor::findOrFail($id);

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
        $this->document = '';
        
        // Load image for preview (from relation or manual fallback)
        $this->oldDocument = $staff->profileImage?->file ?? '';
        if (empty($this->oldDocument) && $staff->image) {
            $imageRec = UploadImage::find($staff->image);
            $this->oldDocument = $imageRec?->file ?? '';
        }

        $this->image_id = $staff->image;

        $this->showModal = true;
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
        SparePartVendor::destroy($this->staffId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff deleted successfully!']);
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
        $this->role = '';
        $this->joining_date = '';
        $this->salary = '';
        $this->monthly_target = '';
        $this->incentives = '';
        $this->staffId = null;
        $this->states = [];
        $this->cities = [];
        $this->document = '';
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }
}
