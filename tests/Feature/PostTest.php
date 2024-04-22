<?php

use App\Livewire\Portal\Post;
use App\Models\Post as PostModal;
use Livewire\Livewire;

// test('it loads posts on mount', function () {
//     // Create dummy post data
//     $posts = PostModal::with('postComments', 'postLikes')->latest()->get();

//     // Call the Livewire component and assert that it loads posts on mount
//     Livewire::test(Post::class)
//         ->assertSet('posts', $posts);
// });

// test('it reloads posts when postCreated event is received', function () {
//     // Create dummy post data
//     $posts = PostModal::all();

//     // Call the Livewire component and assert that it reloads posts when the postCreated event is received
//     Livewire::test(Post::class)
//         ->emit('postCreated')
//         ->assertSet('posts', $posts);
// });
