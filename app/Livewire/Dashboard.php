<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::where('role', 'user')->count();
        return view('livewire.dashboard', ['totalUsers' => $totalUsers]);
    }
}
