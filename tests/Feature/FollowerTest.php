<?php

use App\Models\User;
use App\Models\Follower;
use Livewire\Livewire;
use App\Livewire\Portal\Followers;

it('allows a user to follow and follow back another user without reject', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Followers::class)
        ->call('followUser', $otherUser->id);

    expect(Follower::where('follower_id', $user->id)->where('following_id', $otherUser->id)->exists())->toBeTrue();

    // Login as the user receiving the follow request
    Auth::login($otherUser);

    // Call the acceptFollowRequest method
    Livewire::test(Followers::class)
        ->call('acceptFollowRequest', $user->id);

    // Assert that the follow request has been accepted
    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'accept')
        ->where('is_accepted_follower', 1)
        ->exists())->toBeTrue();

     // Call the followBack method
    Livewire::test(Followers::class)
        ->call('followBack', $user->id);

    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'follow_back')
        ->where('is_accepted_follower', 1)
        ->exists())->toBeTrue();


    Auth::login($user);

     // Call the acceptFollowBackRequest method
    Livewire::test(Followers::class)
        ->call('acceptFollowBackRequest', $otherUser->id);

    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'accepted')
        ->where('is_accepted_following', 1)
        ->exists())->toBeTrue();
});


it('allows a user to follow and other user reject it', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Followers::class)
        ->call('followUser', $otherUser->id);

    expect(Follower::where('follower_id', $user->id)->where('following_id', $otherUser->id)->exists())->toBeTrue();

    // Login as the user receiving the follow request
    Auth::login($otherUser);

    // Call the acceptFollowRequest method
    Livewire::test(Followers::class)
        ->call('rejectFollowRequest', $user->id);

    // Assert that the follow request has been accepted
    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'accept')
        ->where('is_accepted_follower', 1)
        ->doesntExist())->toBeTrue();
});


it('allows a user1 to follow user2 and user2 accept it and follow it back but user1 reject followback request', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(Followers::class)
        ->call('followUser', $otherUser->id);

    expect(Follower::where('follower_id', $user->id)->where('following_id', $otherUser->id)->exists())->toBeTrue();

    // Login as the user receiving the follow request
    Auth::login($otherUser);

    // Call the acceptFollowRequest method
    Livewire::test(Followers::class)
        ->call('acceptFollowRequest', $user->id);

    // Assert that the follow request has been accepted
    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'accept')
        ->where('is_accepted_follower', 1)
        ->exists())->toBeTrue();

     // Call the followBack method
    Livewire::test(Followers::class)
        ->call('followBack', $user->id);

    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'follow_back')
        ->where('is_accepted_follower', 1)
        ->exists())->toBeTrue();


    Auth::login($user);

     // Call the acceptFollowBackRequest method
    Livewire::test(Followers::class)
        ->call('rejectFollowBackRequest', $otherUser->id);

    expect(Follower::where('follower_id', $user->id)
        ->where('following_id', $otherUser->id)
        ->where('status', 'accepted')
        ->where('is_accepted_following', 1)
        ->doesntExist())->toBeTrue();
});