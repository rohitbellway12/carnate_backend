<?php

namespace App\Livewire\Admin;

use App\Models\{MakerType, Maker};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MakerController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal;
    public $title, $maker_type_id, $status = 1, $filter_brand;
    public $maker_id = 0;
    public $makertypes;
    public $search, $status_filter, $adminId;

    protected $listeners = ['delete'];

    public function rules()
    {
        return [
            'title' => 'required|string|unique:makers,title,' . $this->maker_id,
            'maker_type_id' => 'required|exists:maker_types,id',
            'status' => 'required',
        ];
    }

    public function mount()
    {
        $this->makertypes = MakerType::all();
        $this->adminId = Auth::guard('admin')->user()->id;

    }

    public function render()
    {
        $items = Maker::query()
            ->when(filled($this->search), function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhereHas('makerType', function ($q) {
                            $q->where('title', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when(filled($this->filter_brand), function ($query) {
                $query->where('maker_type_id', $this->filter_brand);
            })
            ->when(filled($this->status_filter), function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.maker', compact('items'));
    }

    public function create()
    {
        $this->resetForm();
        $this->makertypes = MakerType::all();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function closeModel()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {

        $this->validate();

        Maker::create([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker added successfully!']);
        $this->resetForm();
        $this->showModal = "";
    }

    public function edit($id)
    {
        $this->resetPage();
        $this->isEdit = true;

        $maker = Maker::findOrFail($id);

        $this->maker_id = $maker->id;
        $this->title = $maker->title;
        $this->status = $maker->status;
        $this->maker_type_id = $maker->maker_type_id;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $receipt = Maker::findOrFail($this->maker_id);
        $receipt->update([
            'title' => $this->title,
            'maker_type_id' => $this->maker_type_id,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->maker_id = $id;
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
        Maker::destroy($this->maker_id);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker deleted successfully!']);
    }

    public function toggleStatus($id, $status)
    {

        $maker = Maker::find($id);

        if ($maker) {

            $maker->update(['status' => $status]);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Status updated successfully']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => '', 'message' => 'Maker not found.']);
        }
    }

    private function resetForm()
    {
        // Reset form fields
        $this->title = '';
        $this->maker_type_id = '';
        $this->status = 1;
        $this->resetPage();
        $this->resetFilter();

    }

    public function resetFilter()
    {
        $this->reset(['search', 'filter_brand', 'status_filter']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedFilterBrand()
    {
        $this->resetPage();
    }
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }


}
