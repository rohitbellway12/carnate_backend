<?php

namespace App\Livewire\Admin;

use App\Models\MakerType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MakersTypeController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit, $showModal, $title, $status = 1, $makertype_id;

    public $search, $status_filter, $adminId;

    protected $listeners = ['delete'];

    public function rules()
    {
        return [
            'title' => 'required|string|unique:maker_types,title,' . $this->makertype_id,
            'status' => 'required',
        ];
    }


    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
    }
    public function render()
    {
        // $items = MakerType::orderBy('created_at', 'desc')->paginate(10); 

        $query = MakerType::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }
        if ($this->status_filter != '') {
            $query->where('status', $this->status_filter);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(10);


        return view('livewire.admin.makers_type', compact('items'));
    }


    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function colseModel()
    {
        $this->resetForm();
        $this->resetValidation();
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        MakerType::create([
            'title' => $this->title,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker Type created successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $makertype = MakerType::findOrFail($id);

        $this->makertype_id = $makertype->id;
        $this->title = $makertype->title;
        $this->status = $makertype->status;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $makertype = MakerType::findOrFail($this->makertype_id);
        $makertype->update([
            'title' => $this->title,
            'status' => $this->status,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker Type updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->makertype_id = $id;
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
        MakerType::destroy($this->makertype_id);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Maker Type deleted successfully!']);
    }

    public function toggleStatus($id, $status)
    {
        $makertype = MakerType::find($id);
        if ($makertype) {
            $makertype->update(['status' => $status]);
            $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Status updated successfully!']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'error', 'title' => '', 'message' => 'Maker Type not found!']);
        }
    }

    private function resetForm()
    {
        $this->title = '';
        $this->status = null;
    }

    public function resetFilter()
    {
        $this->reset(['search', 'status_filter']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
}
