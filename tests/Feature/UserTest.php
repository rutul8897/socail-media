<?php

use App\Livewire\Admin\Users;
use Livewire\Livewire;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    Mail::fake();
});

it('renders successfully', function () {
    Livewire::test(Users::class)
        ->assertStatus(200);
});

it('can open add user form', function () {
    Livewire::test(Users::class)
        ->call('addUser')
        ->assertSet('addUserSection', true)
        ->assertSet('editUserSection', false)
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('phone', '')
        ->assertSet('location', '')
        ->assertSet('about', '');
});

it('can store new user', function () {
    Livewire::test(Users::class)
        ->set('name', 'Test User')
        ->set('email', 'testUser@gmail.com')
        ->set('password', Hash::make('Test@123'))
        ->set('phone', '1234567890')
        ->set('location', 'Test Location')
        ->set('about', 'Test About')
        ->call('storeUser')
        ->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'email' => 'testUser@gmail.com',
    ]);

    // Mail::assertSent(function ($mail) {
    //     return $mail->WelcomeUser('testUser@gmail.com');
    // });
});


it('can open edit user form', function () {
    $user = User::factory()->create();
    Livewire::test(Users::class)
        ->call('editUser', $user->id)
        ->assertSet('addUserSection', false)
        ->assertSet('editUserSection', true)
        ->assertSet('userId', $user->id)
        ->assertSet('name', $user->name)
        ->assertSet('email', $user->email)
        ->assertSet('phone', $user->phone)
        ->assertSet('location', $user->location)
        ->assertSet('about', $user->about);
});

it('can update user', function () {
    $user = User::factory()->create();

    Livewire::test(Users::class)
        ->call('editUser', $user->id)
        ->set('name', 'Updated User')
        ->set('phone', '9876543210')
        ->set('location', 'Updated Location')
        ->set('about', 'Updated About')
        ->call('updateUser')
        ->assertStatus(200);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);
});

it('can delete user', function () {
    $user = User::factory()->create();
    Livewire::test(Users::class)
        ->call('deleteUser', $user->id)
        ->assertStatus(200);
    $this->assertDatabaseMissing('users', [
        'id' => $user->id,
    ]);
});

it('can cancel form', function () {
    Livewire::test(Users::class)
        ->call('addUser')
        ->call('cancel')
        ->assertSet('addUserSection', false)
        ->assertSet('editUserSection', false);
});

// it('can show user posts', function () {
//     $user = User::factory()->create();
//     $post1 = Post::factory()->create(['user_id' => $user->id]);
//     $post2 = Post::factory()->create(['user_id' => $user->id]);
//     Livewire::test(Users::class)
//         ->call('showUserPosts', $user->id)
//         ->assertSet('showUserPostSection', true)
//         ->assertSet('posts', [$post1, $post2]);
// });