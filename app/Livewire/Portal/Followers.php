<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Follower;
use Auth;

class Followers extends Component
{
    use WithPagination;
    public $perPage = 5;

    // protected $listeners = [
    //     'load-more' => 'loadMore'
    // ];

    public function loadMore()
    {
        $this->perPage +=  5;
         // $this->dispatch('loadMore');
    }

    public function render()
    {

        // $followers = Auth::user()->followers;

        // $followings = Auth::user()->followings;

        // $followings = Follower::whereFollowerId(Auth::id())->pluck('following_id')->toArray();

        // $followers = Follower::whereFollowingId(Auth::id())->pluck('follower_id')->toArray();

        // $followerUsers = User::whereIn('id', $followers)->get();

        // $users = User::wherenotIn('id', [Auth::id()])->whereNotIn('id', $followings)->get();

        // $users = $followerUsers->merge($users);

        $users = User::where('id', '!=', Auth::id())->where('role', 'user')->take($this->perPage)->get();

        return view('livewire.portal.followers', [
            'users' => $users
        ])->layout('components.layouts.portal-app');
    }

    public function followUser($followingId)
    {
        Follower::create([
            'follower_id' => Auth::id(),
            'following_id' => $followingId,
            'status' => 'requested'
        ]);
    }

    public function acceptFollowRequest($followerId)
    {
        $authId = Auth::id();
        // $x = Follower::where(function ($query) use ($followerId, $authId) {
        //     $query->where([
        //         'follower_id' => $followerId,
        //         'following_id' => $authId
        //     ])->orWhere([
        //             'follower_id' => $authId,
        //             'following_id' => $followerId
        //     ]);
        // })->where('status', 'follow_back')->exists();

        // if ($x) {
            // Follower::where([
            //     'follower_id' => Auth::id(),
            //     'following_id' => $followerId
            // ])->update([
            //     'status' => 'accepted',
            //     'is_accepted_following' => 1
            // ]);
        // } else {
            Follower::where([
                'follower_id' => $followerId,
                'following_id' => Auth::id()
            ])->update([
                'status' => 'accept',
                'is_accepted_follower' => 1
            ]);
        // }
    }

    public function rejectFollowRequest($followerId)
    {
        Follower::where([
            'follower_id' => $followerId,
            'following_id' => Auth::id()
        ])->delete();
    }

    public function acceptFollowBackRequest($followerId)
    {
        $authId = Auth::id();

        Follower::where([
            'follower_id' => Auth::id(),
            'following_id' => $followerId
        ])->update([
            'status' => 'accepted',
            'is_accepted_following' => 1
        ]);
    }

    public function rejectFollowBackRequest($followerId)
    {
        Follower::where([
            'follower_id' => Auth::id(),
            'following_id' => $followerId
        ])->delete();
    }

    public function followBack($followerId)
    {
        Follower::where([
            'follower_id' => $followerId,
            'following_id' => Auth::id()
        ])->update([
            'status' => 'follow_back',
            'is_accepted_follower' => 1
        ]);
    }


    // public function acceptRequest(User $follower)
    // {
    //     auth()->user()->acceptFollower($follower);
    // }
}
