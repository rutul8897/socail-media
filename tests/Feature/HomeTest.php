<?php

use App\Livewire\Portal\Home;
use App\Models\User;
use Livewire\Livewire;

it('can render content successfully', function () {
    Livewire::test(Home::class)
        ->assertStatus(200);
});

// it('shows validation error when submitting an empty form', function () {
//     Livewire::test(Home::class)
//     ->call('savePost')
//     ->assertHasErrors([
//         'caption', 'photos'
//     ]);
// });

// it('shows validation error when caption length is less than 3', function () {
//     Livewire::test(Home::class)
//         ->set('caption', 'Jo')
//         ->call('savePost')
//         ->assertHasErrors(['name']);
// });
