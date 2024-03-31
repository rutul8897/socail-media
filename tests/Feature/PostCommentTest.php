<?php

use App\Models\User;
use App\Models\Post;
use Livewire\Livewire;
use App\Livewire\Portal\PostComments;

// beforeEach(function () {
//     $this->user = User::find(2);
//     $this->post = Post::with('postComments', 'postLikes', 'user', 'postImages')->find(1);
//     Auth::login($this->user);
// });

// it('mounts component and loads comments for a post', function () {

//     // $this->post->postParentComments()->create([
//     //     'user_id' => Auth::id(),
//     //     'comment' => 'Test comment 1',
//     // ]);
//     // $this->post->postParentComments()->create([
//     //     'user_id' => Auth::id(),
//     //     'comment' => 'Test comment 2',
//     // ]);

//     // dump($this->post->postParentComments()->latest()->take(1)->get());

//     Livewire::test(PostComments::class, ['post' => $this->post])
//     ->assertSet('post', $this->post)
//     ->assertSet('totalParentComments', $this->post->postParentComments()->count())
//     ->assertSet('comments', $this->post->postParentComments()->latest()->take(1)->get());
// });


// it('loads more comments when loadMore method is called', function () {
//     Livewire::test(PostComments::class, ['post' => $this->post])
//         ->call('loadMore')
//         ->assertSet('comments', $this->post->postParentComments()->latest()->take(3)->get())
//         ->assertSet('perPage', 3);
// });