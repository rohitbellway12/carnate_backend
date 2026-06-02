<?php
namespace App\Livewire\Workshop;

use App\Models\Staff;
use App\Models\WorkShopVendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class ManageRoles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $roleName, $roleId, $workshopId, $user;
    public $menus = [], $searchfilter;
    public $permissions = [];
    protected $listeners = ['delete'];
    protected $rules = [
        'roleName' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->workshopId)->first();
        $this->menus = $this->menus();
    }

    public function menus()
    {
        $permission = Permission::orderBy('menu', 'asc')->where('guard_name', 'web')->get();
        $menus = [];
        foreach ($permission->toArray() as $key => $value) {
            $menus[$value['menu']][] = $value;
        }
        return $menus;
    }
    public function render()
    {
        $roles = Role::orderBy('created_at', 'desc')->where('guard_name', 'web');
        if ($this->searchfilter) {
            $roles = $roles->where('name', 'like', '%' . $this->searchfilter . '%');
        }
        $roles = $roles->paginate(10);
        return view('livewire.workshop.manage-roles', compact('roles'));
    }



    public function create()
    {
        $this->resetErrorBag();
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
        $role = Role::create(['name' => $this->roleName]);
        $role->syncPermissions($this->permissions);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Role added successfully!']);
        $this->resetForm();
        $this->resetErrorBag();
        $this->showModal = false;
    }


    public function edit($id)
    {
        $this->resetErrorBag();
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

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Role updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        if($id == 19 || $id == 21 || $id == 32){
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
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Staff deleted successfully!']);
    }

    private function resetForm()
    {
        $this->roleName = '';
        $this->permissions = [];

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
