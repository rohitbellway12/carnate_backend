<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;  
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;
 
class ManageAdminPermissions extends Component
{

    protected $paginationTheme = 'bootstrap';
    
    use WithPagination;  

    public $isEdit = false, $showModal = false;
    public $permissionName,$permissionId;
    protected $listeners = ['delete'];
    protected $rules = [
        'permissionName' => 'required|string|max:255',
    ];
 

    public function render()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->where('guard_name','admin')->paginate(10);
        return view('livewire.admin.manage-admin-permissions', compact('permissions'));
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
    
        $actions = ['show', 'add', 'edit', 'delete'];
    
        foreach ($actions as $action) {
            Permission::create([
                'name' => $this->permissionName . '-' . $action,
                'menu' => $this->permissionName,
                'guard_name'=>'admin', 
            ]);
        }
    
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Permissions added successfully!']);
    
        $this->resetForm();
        $this->showModal = false;
    }
    
    

    public function edit($id)
    {
        $this->isEdit = true;
        $permission = Permission::findOrFail($id); 
        $this->permissionId = $permission->id; 
        $this->permissionName = $permission->name; 
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
     
        Permission::where('name', 'LIKE', $this->permissionName . '-%')->where('guard_name','web')->delete();
  
        $actions = ['add', 'edit', 'show', 'delete'];
        foreach ($actions as $action) {
            Permission::create([
                'name' => $this->permissionName . '-' . $action, 
            ]);
        }
    
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Permissions updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }
    
   
 

    public function confirmDelete($id)
    {
        $this->permissionId = $id;
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
        Permission::destroy($this->permissionId);
        $this->dispatch('swal:toast', ['type' => 'success','message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->permissionName = '';

    }

}
