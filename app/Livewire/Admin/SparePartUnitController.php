<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SparePartUnit;
use Illuminate\Support\Facades\Auth;

class sparePartUnitController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $isEdit, $showModal, $sparePartUnitId, $sparepart_label, $title, $adminId, $searchfilter;
    protected $listeners = ['delete'];

    public function mount()
    {
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        $units = SparePartUnit::with('user');
        if ($this->searchfilter) {
            $units = $units->where('title', 'like', '%' . $this->searchfilter . '%');

        }
        $units = $units->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.spare_part_unit', compact('units'));
    }

    public function create()
    {
        $this->resetForm();
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

        $this->validate([
            'title' => "required|unique:units,title",
        ], [
            'title.required' => 'The Spare Part Unit field is required.',
            'title.unique' => 'The Spare Part Unit has already been taken.'
        ]);

        $sparePartUnit = new SparePartUnit();
        $sparePartUnit->title = $this->title;
        $sparePartUnit->save();


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Unit added successfully!',
        ]);

        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $sparePartUnit = SparePartUnit::findOrFail($id);

        $this->sparePartUnitId = $sparePartUnit->id;
        $this->title = $sparePartUnit->title;

        $this->showModal = true;
    }

    public function update()
    {

        $valArr = [
            'title' => ["required"],
        ];

        $this->validate($valArr);


        $sparePartUnit = SparePartUnit::find($this->sparePartUnitId);
        $sparePartUnit->title = $this->title;
        $sparePartUnit->save();


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Spare Part Unit updated successfully!',
        ]);

        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->sparePartUnitId = $id;
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
        SparePartUnit::destroy($this->sparePartUnitId);
        $this->dispatch('swal:toast', ['message' => 'Spare Part Unit deleted successfully!']);
    }

    private function resetForm()
    {
        $this->title = '';
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
