<?php

namespace App\Livewire\Workshop;

use App\Models\{City, Staff, Country, State, Branch, LabourCharge, WorkShopVendor, UploadImage};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.workshop-app')]
class LabourChargeController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches;
    public $staffId, $userId, $workshopId, $role, $roles, $user, $salary, $incentives, $joining_date, $showUserModal, $doucument, $file;
    public $states = [];
    public $cities = [], $searchStaff, $seachRole;
    public $imageName, $ImageData, $image;

    public $title, $labour_type,  $outsource_price, $tax_type, $tax_percentage, $price, $total_price, $labourId;

    protected $listeners = ['delete'];

    protected $rules = [
        'title' => 'required',
        'price' => 'required',

    ];

    public function mount()
    {

        $this->workshopId = Auth::guard('workshop')->user()->id;
    }

    public function render()
    {
        $items = LabourCharge::where('user_id', $this->workshopId);

        if ($this->searchStaff) {
            $items = $items->where(function ($query) {
                $query->where('title', 'like', '%' . $this->searchStaff . '%');
            });
        }

        $items = $items->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.workshop.labourcharge', compact('items'));
    }

    public function create()
    {

        $this->resetErrorBag();
        $this->reset('title', 'price', 'tax_percentage', 'tax_type', 'total_price');
        $this->resetPage();
        $this->isEdit = false;
        $this->showModal = true;
    }
    public function updatedTaxPercentage($value)
    {
        $this->calculatePrice();
    }

    public function updatedPrice()
    {
        $this->calculatePrice();
    }
    public function updatedTaxType()
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $price = 0;
        $taxPercentage = floatval($this->tax_percentage);
        $sellingAmount = floatval($this->price);

        if ($this->tax_type == 'include' && $taxPercentage) {
            $price = round($sellingAmount);
        } elseif ($this->tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
           // dd($price);
        } else {
            $price = $sellingAmount;
        }

        $this->total_price = $price;
    }

    // public function store()
    // {
    //     $this->validate();


    //     $staff = LabourCharge::create([
    //         'title' => $this->title,
    //         'price' => $this->price,
    //         'gst' => $this->tax_percentage,
    //         'gst_type' => $this->tax_type,
    //         'user_id' => $this->workshopId,
    //         'total' => $this->total_price,
    //         'status' => 1,

    //     ]);
    //     $this->reset('title', 'price', 'tax_percentage', 'tax_type', 'total_price');
    //     $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour change added successfully!']);

    //     $this->resetErrorBag();
    //     $this->showModal = false;
    // }
   public function store()
    {
  // dd($this->all());
    $rules = [
        'title' => 'required|string',
        'labour_type' => 'required|in:inhouse,outsource',
        'price' => 'required|numeric|min:1',
        'tax_type' => 'nullable|in:include,exclude',
        'tax_percentage' => 'nullable|numeric|min:0|max:100',
    ];

    if ($this->labour_type === 'outsource') {
        $rules['outsource_price'] = 'required|numeric|min:1';
    }

    $this->validate($rules);

    $staff = LabourCharge::create([
        'title' => $this->title,
        'labour_type' => $this->labour_type,
        'price' => $this->price,
        'outsource_price' => $this->labour_type === 'outsource' ? $this->outsource_price : null,
        'gst' => $this->tax_percentage,
        'gst_type' => $this->tax_type,
        'user_id' => $this->workshopId,
        'total' => $this->total_price,
        'profit' => $this->labour_type === 'outsource'
    ? ($this->outsource_price - $this->price)
    : null,

        'status' => 1,
    ]);

    $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour charge added successfully!']);
    $this->reset('title', 'price', 'outsource_price', 'tax_percentage', 'tax_type', 'labour_type', 'total_price');

    $this->showLabourCharge = false;
     $this->showModal = false;
    }
    
 
    public function edit($id)
    {
        $this->resetErrorBag();
        $this->resetPage();
        
        $this->isEdit = true;
        $this->showModal = true;
        $labour = LabourCharge::findOrFail($id);

        $this->labourId = $labour->id;
        $this->title = $labour->title;
        $this->labour_type = $labour->labour_type;
        $this->price = $labour->price;
        $this->outsource_price = $labour->outsource_price;
        $this->tax_percentage = $labour->gst;
        $this->tax_type = $labour->gst_type;
        $this->total_price = $labour->total;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'labour_type' => 'required|in:inhouse,outsource',
            'price' => 'required|numeric|min:1',
            'outsource_price' => $this->labour_type === 'outsource' ? 'required|numeric|min:1' : 'nullable',
            'tax_type' => 'nullable|in:include,exclude',
            'tax_percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $labour = LabourCharge::findOrFail($this->labourId);
        $labour->update([
            'title' => $this->title,
            'labour_type' => $this->labour_type,
            'price' => $this->price,
            'outsource_price' => $this->labour_type === 'outsource' ? $this->outsource_price : null,
            'gst' => $this->tax_percentage,
            'gst_type' => $this->tax_type,
            'total' => $this->total_price,
            'profit' => $this->labour_type === 'outsource' ? ($this->outsource_price - $this->price) : null,
        ]);

        $this->reset('title', 'price', 'outsource_price', 'tax_percentage', 'tax_type', 'total_price', 'labour_type');
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour Charge updated successfully!']);

        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->labourId = $id;

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
        LabourCharge::destroy($this->labourId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Labour deleted successfully!']);
    }

    public function resetFilter()
    {
        $this->searchStaff = "";
        $this->seachRole = "";
    }

}
