<?php

use App\Livewire\Portal\Profile;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;

// it('can update user profile with photo', function () {
//     // Create a user
//     $user = User::factory()->create();

//     Storage::fake('public/user-images/'); // Mock storage for file uploads

//     // Initialize the Livewire component
//     Livewire::actingAs($user)
//         ->test(Profile::class)
//         ->set('name', 'John Doe')
//         ->set('location', 'New York')
//         ->set('about', 'Lorem ipsum dolor sit amet.')
//         ->set('photo', UploadedFile::fake()->image('avatar.jpg'))
//         ->call('updateProfile');

//     // Assert that the user profile is updated in the database
//     $this->assertDatabaseHas('users', [
//         'id' => $user->id,
//         'name' => 'John Doe',
//         'location' => 'New York',
//         'about' => 'Lorem ipsum dolor sit amet.',
//     ]);

//     // Assert that the user's photo is uploaded and stored
//     // $this->assertNotNull($user->fresh()->photo);
// });

// it('can update user profile without photo', function () {
//     // Create a user
//     $user = User::factory()->create();

//     // Initialize the Livewire component
//     Livewire::actingAs($user)
//         ->test(Profile::class)
//         ->set('name', 'John Doe')
//         ->set('location', 'New York')
//         ->set('about', 'Lorem ipsum dolor sit amet.')
//         ->call('updateProfile');

//     // Assert that the user profile is updated in the database
//     $this->assertDatabaseHas('users', [
//         'id' => $user->id,
//         'name' => 'John Doe',
//         'location' => 'New York',
//         'about' => 'Lorem ipsum dolor sit amet.',
//     ]);

//     // Assert that the user's photo remains unchanged
//     // $this->assertNull($user->fresh()->photo);
// });