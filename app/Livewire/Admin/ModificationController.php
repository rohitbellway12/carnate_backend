<?php

namespace App\Livewire\Admin;

use App\Models\{Mmodel, MakerType, Maker, ModelYear, Modification};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ModificationController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal;
    public $title, $brand, $variant, $year = [], $status = 1;
    public $filter_brand, $filter_variant, $filter_year, $filter_status;
    public $brands = [], $variants = [], $years = [];
    public $modification_id = false;
    public $search, $adminId;
    protected $listeners = ['delete'];

    protected $rules = [
        'title' => 'required|string',
        'brand' => 'required',
        'variant' => 'required',
        'year' => 'required|array',
        'status' => 'required',
    ];

    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
        $this->brands = MakerType::whereStatus(1)->pluck('title', 'id');

        $startYear = 1990;
        $currentYear = date('Y');
        $this->years = range($currentYear, $startYear);

    }

    public function render()
    {
        $modifications = Modification::query();

        if (filled($this->search)) {
            $search = trim($this->search);
            $modifications->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('brand_name', 'like', '%' . $search . '%')
                    ->orWhere('variant_name', 'like', '%' . $search . '%')
                    ->orWhere('year', 'like', '%' . $search . '%');
            });
        }
        
        if (filled($this->filter_brand)) {
            $modifications->where('brand_id', $this->filter_brand);
        }
        
        if (filled($this->filter_variant)) {
            $modifications->where('variant_id', $this->filter_variant);
        }
        
        if (filled($this->filter_year)) {
            $modifications->where('year', $this->filter_year);
        }
        
        if (isset($this->filter_status) && $this->filter_status !== '') {
            $modifications->where('status', $this->filter_status);
        }

        $modifications = $modifications->orderBy('created_at', 'desc')->paginate(10);
        
        // Refresh brands and variants for filters
        $filter_brands = MakerType::whereStatus(1)->pluck('title', 'id');
        $filter_variants = [];
        if ($this->filter_brand) {
            $filter_variants = Maker::where('maker_type_id', $this->filter_brand)->pluck('title', 'id');
        }

        return view('livewire.admin.modification', [
            'modifications' => $modifications,
            'filter_brands' => $filter_brands,
            'filter_variants' => $filter_variants,
        ]);
    }

    public function updating($property)
    {
        $this->resetPage();
    }


    public function create()
    {
        $this->reset('showModal', 'title', 'brand', 'variant', 'variants', 'year', 'status');
        $this->resetErrorBag();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function updatedBrand($value)
    {
        $this->variants = Maker::where('maker_type_id', $value)->pluck('title', 'id');
        $this->reset('variant');

    }

    public function store()
    {

        $this->validate();
        foreach ($this->year as $year) {
            Modification::create([
                'title' => $this->title,
                'brand_id' => $this->brand,
                'brand_name' => $this->brands[$this->brand],
                'variant_id' => $this->variant,
                'variant_name' => $this->variants[$this->variant],
                'year' => $year,
                'status' => $this->status,
            ]);
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Modification added successfully!']);
        $this->reset('showModal', 'title', 'brand', 'variant', 'variants', 'year', 'status');
        $this->resetFilter();


    }

    public function edit($id)
    {
        $this->isEdit = true;

        $this->reset('showModal', 'title', 'brand', 'variant', 'variants', 'year', 'status');
        $this->resetErrorBag();
        $modification = Modification::findOrFail($id);

        $this->modification_id = $modification->id;
        $this->title = $modification->title;
        $this->brand = $modification->brand_id;
        $this->variant = $modification->variant_id;
        $this->year = $modification->year;
        $this->status = $modification->status;

        $this->variants = Maker::where('maker_type_id', $modification->brand_id)->pluck('title', 'id');

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string',
            'brand' => 'required',
            'variant' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);
        // dd($this->year);
        $receipt = Modification::findOrFail($this->modification_id);

        $receipt->update([
            'title' => $this->title,
            'brand_id' => $this->brand,
            'brand_name' => $this->brands[$this->brand],
            'variant_id' => $this->variant,
            'variant_name' => $this->variants[$this->variant],
            'year' => $this->year,
            'status' => $this->status,
        ]);



        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Modification updated successfully!']);

        $this->reset('showModal', 'title', 'brand', 'variant', 'variants', 'year', 'status');
        $this->resetFilter();

        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->modification_id = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete'
        ]);
    }


    public function delete()
    {
        Modification::destroy($this->modification_id);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Modification deleted successfully!']);
    }

    public function toggleStatus($id, $status)
    {

        $modification = Modification::find($id);

        if ($modification) {

            $modification->update(['status' => $status]);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Status updated successfully']);

        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => '', 'message' => 'Modification not found.']);
        }
    }

    public function resetFilter()
    {
        $this->reset(['search', 'filter_brand', 'filter_variant', 'filter_year', 'filter_status']);
    }


    public function updatedFilterBrand()
    {
        if ($this->filter_brand) {
            $this->variants = Maker::where('maker_type_id', $this->filter_brand)->pluck('title', 'id');
            $this->reset('variant');
        } else {
            $this->variants = [];
        }

        $this->reset('filter_variant');

    }

}
