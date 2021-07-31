<?php

namespace App\Http\Livewire\Visor;

use App\Models\College;
use Livewire\Component;

class Visor extends Component
{
    public $college;
    public $populationCenter;

    public function getColleges()
    {
        return $this->college = College::find(1);
    }

    public function render()
    {
        
        return view('livewire.visor.visor');
    }
}
