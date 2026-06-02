<?php

namespace App\Livewire\Admin;

use App\Models\VehicleColors;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleColorController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $vehiclecolors = VehicleColors::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.vehicle_color', compact('vehiclecolors'));
    }

    
}
