<?php
namespace App\Livewire\Sparepart;

use App\Models\Admin;
use App\Models\SparePartVendor;
use App\Models\Staff;
use App\Models\WorkShopVendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;  
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;


class ManageSparePartRoles extends Component
{
    use WithPagination;  

    protected $paginationTheme = 'bootstrap';
    
    public $isEdit = false, $showModal = false;
    public $roleName,$roleId,$adminId,$user;
    public $menus = [];
    public $permissions = [];
    protected $listeners = ['delete'];
    protected $rules = [
        'roleName' => 'required|string|max:255',
    ];
 
    public function mount()
    {
        $this->adminId = Auth::guard('sparepart')->user()->id; 
        $this->user = SparePartVendor::where('id', $this->adminId)->first();
        $this->menus = $this->menus();
    }

    public function menus()
    {
        $permission = Permission::orderBy('menu', 'asc')->where('guard_name','sparepart')->get();
        $menus = [];
        foreach ($permission->toArray() as $key => $value) {
            $menus[$value['menu']][] = $value;
        }
        return $menus;
    }
    #[Layout('components.layouts.spare-part-app')]
    public function render()
    {
        $roles = Role::orderBy('created_at', 'desc')->where('guard_name','sparepart')->paginate(10);
        return view('livewire.sparepart.manage-sparepart-roles', compact('roles'));
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
 
        if (empty($this->permissions)) { 
            $this->dispatch('swal:toast', ['type' => 'info', 'message' => 'Please select at least one permission.']);
            return;
        } 
             $role = Role::create(['name' => $this->roleName,'guard_name' => 'sparepart']);
            $role->syncPermissions($this->permissions);
           
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Role added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }
    

    public function edit($id)
    {
        $this->isEdit = true;
        $role = Role::findOrFail($id); 
        $this->roleId = $role->id; 
        $this->roleName = $role->name;
         
        $this->permissions = $role->permissions->pluck('name')->toArray();
        
        $this->showModal = true;
    }
    

    public function update()
    {
        $this->validate();
    
        
        if (empty($this->permissions)) { 
            $this->dispatch('swal:toast', ['type' => 'info', 'message' => 'Please select at least one permission.']);
            return;
        }

        $role = Role::findOrFail($this->roleId);
        $role->update([
            'name' => $this->roleName,
        ]);    
        $role->syncPermissions($this->permissions);
        // $roles = Role::where('id', 30)->first();
        // $staff = SparePartVendor::find(24);
        // $staff->assignRole($roles->name);
        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Role updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }
    

   
 

    public function confirmDelete($id)
    {
        if($id == 30){
            $this->dispatch('swal:toast', ['type' => 'warning', 'message' => 'You do not have the right permission to delete this.']);
            return;
        }

        $this->roleId = $id;
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
        Role::destroy($this->roleId);
        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->roleName = '';

    }

}
