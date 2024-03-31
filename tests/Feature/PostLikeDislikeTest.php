<?php

use Livewire\Livewire;
use App\Livewire\Portal\PostLikeDislike;
use App\Models\User;
use App\Models\PostLike;

beforeEach(function () {
    $this->user = User::find(2);
    Auth::login($this->user);
});

it('mounts component and checks if user has liked the post', function () {
    $postId = 1; // Replace with a valid post ID

    // Assuming there is no post like initially
    // PostLike::where([
    //     'post_id' => $postId,
    //     'user_id' => $this->user->id,
    // ])->delete();

    Livewire::test(PostLikeDislike::class, ['postId' => $postId])
        ->assertSet('isLiked', false);
});


it('likes a post and updates like status', function () {
    $postId = 1; // Replace with a valid post ID

    Livewire::test(PostLikeDislike::class, ['postId' => $postId])
        ->call('postLikeDislike')
        ->assertSet('isLiked', true);

    // Assert that a post like has been created
    expect(PostLike::where([
        'post_id' => $postId,
        'user_id' => $this->user->id,
    ])->exists())->toBeTrue();
});

it('dislikes a post and updates like status', function () {
    $postId = 1; // Replace with a valid post ID

     // Assuming there is no post like initially
    // PostLike::where([
    //     'post_id' => $postId,
    //     'user_id' => $this->user->id,
    // ])->delete();

    Livewire::test(PostLikeDislike::class, ['postId' => $postId])
        ->call('postLikeDislike')
        ->assertSet('isLiked', false);

    // Assert that the post like has been deleted
    expect(PostLike::where([
        'post_id' => $postId,
        'user_id' => $this->user->id,
    ])->exists())->toBeFalse();
});
