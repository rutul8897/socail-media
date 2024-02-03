<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public function render()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }
}
