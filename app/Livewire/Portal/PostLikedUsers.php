<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\User;

class PostLikedUsers extends Component
{
    public $postId;
    public $likedUsers = [];

    protected $listeners = ['showLikedUsers'];

    public function showLikedUsers($postId)
    {
        $this->postId = $postId;
        $this->likedUsers = User::whereHas('postLikes', function ($postlike) use ($postId) {
            $postlike->where('post_id', $postId);
        })->get();
        \Log::info($postId);
        $this->dispatch('open-comment-modal', $postId);
    }

    public function hideLikeModal($postId)
    {
        $this->dispatch('close-comment-modal', $postId);
        // $this->postId = null;
    }

    public function render()
    {
        return view('livewire.portal.post-liked-users');
    }
}
