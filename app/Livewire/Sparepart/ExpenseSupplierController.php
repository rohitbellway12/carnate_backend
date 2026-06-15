<?php namespace App\Livewire\Sparepart;

use App\Models\SparePartSupplier;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class ExpenseSupplierController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal, $supplierId, $sparepartId;
    public $mobile_no, $business_first_name, $business_address, $gstin, $owner_first_name, $contact_1, $contact_2, $email;
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

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
    }

    public function render()
    {
        $query = SparePartSupplier::orderBy('id', 'desc')
            ->where('user_id', $this->sparepartId);
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('mobile_no', 'like', '%' . $this->search . '%')
                    ->orWhere('business_first_name', 'like', '%' . $this->search . '%');
            });
        }
        $suppliers = $query->paginate(10);
        return view('livewire.sparepart.expense_supplier', compact('suppliers'));
    }

    public function resetFields()
    {
        $this->supplierId = null;
        $this->mobile_no = null;
        $this->business_first_name = null;
        $this->business_address = null;
        $this->gstin = null;
        $this->owner_first_name = null;
        $this->contact_1 = null;
        $this->contact_2 = null;
        $this->email = null;
    }

    public function create()
    {
        $this->resetFields();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openModal()
    {
        $this->create();
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();
        SparePartSupplier::create([
            'mobile_no' => $this->mobile_no,
            'business_first_name' => $this->business_first_name,
            'business_address' => $this->business_address,
            'gstin' => $this->gstin,
            'owner_first_name' => $this->owner_first_name,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'email' => $this->email,
            'user_id' => $this->sparepartId,
        ]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier added successfully!'
        ]);

        $this->showModal = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        $supplier = SparePartSupplier::findOrFail($id);
        $this->supplierId = $supplier->id;
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
        $supplier = SparePartSupplier::findOrFail($this->supplierId);
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
        $this->supplierId = $id;
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
        SparePartSupplier::destroy($this->supplierId);
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Supplier deleted successfully!'
        ]);
    }

    public function updatedMobileNo($value)
    {
        if ($this->isEdit) {
            return;
        }

        $existing = SparePartSupplier::where('mobile_no', $value)->first();
        if ($existing) {
            $this->supplierId = $existing->id;
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
