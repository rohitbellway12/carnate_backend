<?php

namespace App\Livewire\Admin;

use App\Models\JobCard;
use App\Models\Vehicle;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        $vehicles = Vehicle::where([['soft_delete', 0]])->orderBy('id', 'DESC');
        if ($this->search) {
            $search = trim($this->search);
            $vehicles->where(function ($q) use ($search) {
                $q->where('modelname', 'like', '%' . $search . '%')
                    ->Orwhere('number_plate', 'like', '%' . $search . '%');
            });
        }
        $vehicles = $vehicles->paginate(10);

        foreach ($vehicles as $vehical) {
            $lastService = JobCard::select('id', 'entry_date')->where('vehicle_id', $vehical->id)->orderBy('entry_date', 'desc')->first();

            $vehical->lastServiceDate = $lastService ? Carbon::parse($lastService->entry_date) : null;
            $vehical->upcomingServiceDate = null;
        }

        return view('livewire.admin.vehicles', compact('vehicles'));
    }

    public function resetFilter()
    {
        $this->reset('search');
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedSearchfilter()
    {
        $this->resetPage();
    }
}
