<?php

use App\Livewire\Portal\Home;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->user = User::find(2);
    Auth::login($this->user);
});

it('can render content successfully', function () {
    Livewire::test(Home::class)
        ->assertStatus(200);
});

it('shows validation error when submitting an empty form', function () {
    Livewire::test(Home::class)
    ->call('savePost')
    ->assertHasErrors([
        'caption', 'photos'
    ]);
});

it('shows validation error when caption length is less than 3', function () {
    Livewire::test(Home::class)
        ->set('caption', 'Jo')
        ->call('savePost')
        ->assertHasErrors(['caption']);
});

it('shows validation error when submit form without image', function () {
    Livewire::test(Home::class)
        ->set('photos', '')
        ->call('savePost')
        ->assertHasErrors(['photos']);
});

it('can create a new post', function () {
    Storage::fake('public/post-images/'); // Mock storage for file uploads

    $imageFiles = [
        UploadedFile::fake()->image('test-image1.jpg'),
        UploadedFile::fake()->image('test-image2.jpg'),
    ];

    Livewire::test(Home::class)
        ->set('caption', 'Test caption')
        ->set('user_id', $this->user->id)
        ->set('photos', $imageFiles)
        ->call('savePost');

    $this->assertDatabaseHas('posts', [
        'caption' => 'Test caption',
        'user_id' => $this->user->id
    ]);
});

it('can render content successfully with search', function () {
    Livewire::test(Home::class)
        ->set('searchTerm', 'Test caption')
        ->assertSee('Test caption')
        ->assertDontSee('Another post');
});
