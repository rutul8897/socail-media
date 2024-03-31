<?php

use App\Livewire\Auth\Logout;
use Livewire\Livewire;
use App\Models\User;

it('can logout user', function () {
    // Create a user and log them in
    $user = User::factory()->create();
    Auth::login($user);

    // Ensure the user is logged in
    expect(Auth::check())->toBeTrue();

    // Run the logout Livewire component
    Livewire::test(Logout::class)
        ->call('logout');

    // Ensure the user is logged out after calling the logout method
    expect(Auth::check())->toBeFalse();

    // Ensure the user is redirected to the login page
    Livewire::test(Logout::class)
        ->call('logout')
        ->assertRedirect('/login');
});
