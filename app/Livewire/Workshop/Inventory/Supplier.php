<?php

namespace App\Livewire\Workshop\Inventory;

use Livewire\Component;
use App\Models\WorkshopSupplier;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
#[Layout('components.layouts.workshop-app')]
class Supplier extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $supplier_id;
    public $mobile_no, $business_first_name, $business_address, $gstin, $owner_first_name, $contact_1, $contact_2, $email;
    public $showModal = false, $isEdit = false;
    public $search = '';

    protected $listeners = ['delete'];

    protected $rules = [
        'mobile_no' => 'required|string',
        'business_first_name' => 'required|string',
        'business_address' => 'nullable|string',
        'gstin' => 'nullable|string',
        'owner_first_name' => 'required|string',
        'contact_1' => 'required|string',
        'contact_2' => 'nullable|string',
        'email' => 'nullable|email',
    ];

    public function render()
    {
        $query = WorkshopSupplier::orderBy('id', 'desc') ->where('user_id', Auth::guard('workshop')->user()->id);
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('mobile_no', 'like', '%'.$this->search.'%')
                  ->orWhere('business_first_name', 'like', '%'.$this->search.'%')
                  ->orWhere('owner_first_name', 'like', '%'.$this->search.'%');
            });
        }
        $suppliers = $query->paginate(10);
        return view('livewire.workshop.inventory.supplier', compact('suppliers'));
    }

    public function resetFields()
    {
        $this->mobile_no = $this->business_first_name = $this->business_address = $this->gstin = null;
        $this->owner_first_name = $this->contact_1 = $this->contact_2 = $this->email = null;
        $this->supplier_id = null;
    }

    public function openModal()
    {
        $this->resetFields();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();
        WorkshopSupplier::create([
            'mobile_no' => $this->mobile_no,
            'business_first_name' => $this->business_first_name,
            'business_address' => $this->business_address,
            'gstin' => $this->gstin,
            'owner_first_name' => $this->owner_first_name,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'email' => $this->email,
             'user_id' => Auth::guard('workshop')->user()->id,
        ]);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier added successfully!'
        ]);
        $this->closeModal();
    }

    public function edit($id)
    {
        $supplier = WorkshopSupplier::findOrFail($id);
        $this->supplier_id = $supplier->id;
        $this->mobile_no = $supplier->mobile_no;
        $this->business_first_name = $supplier->business_first_name;
        $this->business_address = $supplier->business_address;
        $this->gstin = $supplier->gstin;
        $this->owner_first_name = $supplier->owner_first_name;
        $this->contact_1 = $supplier->contact_1;
        $this->contact_2 = $supplier->contact_2;
        $this->email = $supplier->email;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();
        $supplier = WorkshopSupplier::findOrFail($this->supplier_id);
        $supplier->update([
            'mobile_no' => $this->mobile_no,
            'business_first_name' => $this->business_first_name,
            'business_address' => $this->business_address,
            'gstin' => $this->gstin,
            'owner_first_name' => $this->owner_first_name,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'email' => $this->email,
        ]);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier updated successfully!'
        ]);
        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->supplier_id = $id;
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
        $supplier = WorkshopSupplier::findOrFail($this->supplier_id);
        $supplier->delete();
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier deleted successfully!'
        ]);
    }

    public function updatedMobileNo($value)
    {
        // If we're already in edit mode, don't auto-load existing supplier data
        if ($this->isEdit) {
            return;
        }
        
        $existing = WorkshopSupplier::where('mobile_no', $value)->first();
        if ($existing) {
            $this->supplier_id = $existing->id;
            $this->business_first_name = $existing->business_first_name;
            $this->business_address = $existing->business_address;
            $this->gstin = $existing->gstin;
            $this->owner_first_name = $existing->owner_first_name;
            $this->contact_1 = $existing->contact_1;
            $this->contact_2 = $existing->contact_2;
            $this->email = $existing->email;
            $this->isEdit = true;
        } else {
            $this->resetFields();
            $this->mobile_no = $value;
            $this->isEdit = false;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage('page');
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage('page');
    }
}
