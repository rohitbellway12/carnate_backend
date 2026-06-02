<?php

namespace App\Livewire\Workshop;

// Create a Livewire component called MarkDent.php
namespace App\Http\Livewire;

use Livewire\Component;

class MarkDent extends Component
{
    public $imageUrl = 'assets/dentcar/car.png';

    public function render()
    {
        return view('livewire.mark-dent');
    }

}
