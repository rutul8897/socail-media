<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

it('can render login page content successfully', function () {
    Livewire::test(Login::class)
        ->assertStatus(200);
});

it('can login for admin', function () {
    Livewire::test(Login::class)
        ->set('email', 'admin@softui.com')
        ->set('password', 'secret')
        ->call('login');

    $this->assertTrue(auth()->check());
});
