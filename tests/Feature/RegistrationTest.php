<?php

use App\Livewire\Auth\SignUp;
use App\Livewire\Auth\Login;
use Livewire\Livewire;
use App\Models\User;

it('renders successfully', function () {
    Livewire::test(SignUp::class)
        ->assertStatus(200);
});

it('shows validation error when submitting an empty form', function () {
    Livewire::test(SignUp::class)
    ->call('register')
    ->assertHasErrors([
        'name', 'email', 'password'
    ]);
});

it('shows validation error when name length is less than 3', function () {
    Livewire::test(SignUp::class)
        ->set('name', 'Jo')
        ->call('register')
        ->assertHasErrors(['name']);
});

it('shows validation error when email is wrong', function () {
    Livewire::test(SignUp::class)
        ->set('email', 'Jo@example@sss')
        ->call('register')
        ->assertHasErrors(['email']);
});

it('shows validation error when password requirement not match', function () {
    Livewire::test(SignUp::class)
        ->set('password', 'etst')
        ->call('register')
        ->assertHasErrors(['password']);
});

it('register new user with valid data', function () {
    Livewire::test(SignUp::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@gmail.com')
        ->set('password', 'password')
        ->call('register')
        ->assertRedirect('/');

    // Assert that a user with the given email has been created
    expect(User::where('email', 'john@gmail.com')->exists())->toBeTrue();
});

// it('tests the RegisterForm validation rules', function () {
//     $user = User::factory()->create();

//     Livewire::test(SignUp::class, ['user' => $user])
//         ->call('register')
//         ->assertHasErrors();
// })->with([
//     'name is null' => ['user.name', null, 'required'],
// ]);

// it('tests the RegisterForm with invalid data', function () {
//     $user = [
//         'name' => Str::random(2),
//         'email' => 'test@test.test',
//         'password' => 'pass'
//     ];

//     Livewire::test(SignUp::class, ['user' => $user])
//         ->call('register')
//         ->assertStatus(302);
// });