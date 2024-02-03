<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\PostLike;
use Auth;

class PostLikeDislike extends Component
{
    public $postId;
    public $isLiked;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->isLiked = PostLike::where([
            'post_id' => $this->postId,
            'user_id' => Auth::id()
        ])->exists() ? true : false;
    }

    public function postLikeDislike()
    {
        $postLike =  PostLike::where([
            'post_id' => $this->postId,
            'user_id' => Auth::id()
        ])->first();

        if ($postLike) {
            $postLike->delete();
            $this->isLiked = false;
        } else {
            PostLike::create([
                'post_id' => $this->postId,
                'user_id' => Auth::id()
            ]);
            $this->isLiked = true;
        }

         $this->dispatch('updateLikes', $this->postId);
    }

    public function render()
    {
        return view('livewire.portal.post-like-dislike');
    }
}
