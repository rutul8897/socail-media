<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Post as PostModal;

class Post extends Component
{
    public $posts;
    protected $listeners = ['postCreated' => 'loadPosts'];

    public function mount()
    {
        $this->posts = PostModal::with('postComments', 'postLikes')->latest()->get();
        // $this->dispatch('loadComments');
    }

    public function loadPosts()
    {
        $this->posts = PostModal::with('postComments', 'postLikes')->latest()->get();
    }

    public function render()
    {
        return view('livewire.portal.post');
    }
}
