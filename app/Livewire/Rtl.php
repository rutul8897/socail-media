<?php

namespace App\Livewire;

use Livewire\Component;

class Rtl extends Component
{
    public function render()
    {
        return view('livewire.rtl')->layout('layouts.base');
    }
}
