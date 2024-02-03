<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\PostComment;
use Auth;

class PostNestedComments extends Component
{
    public $postComment;
    public $nestedComments = [];
    public $nestedPerPage =  1;
    public $totalNestedComments;
    public $replyComment = null;

    protected $listeners = ['loadNestedComments' => 'loadNestedComments'];


    public function mount(PostComment $postComment)
    {
        $this->postComment = $postComment;
        // \Log::info($this->postComment);
        // $this->totalNestedComments = $this->postComment->nestedComments->count();
        $this->loadNestedComments();
    }

    public function loadNestedComments()
    {
        $this->totalNestedComments = $this->postComment->nestedComments->count();
        $this->nestedComments = $this->postComment->nestedComments()->latest()->take($this->nestedPerPage)->get();
    }

    public function loadMoreNestedComments()
    {
        $this->nestedPerPage += 1;
        $this->loadNestedComments();
    }

    // public function postReplyComment($postId, $parentId)
    // {
    //     PostComment::create([
    //         'user_id' => Auth::user()->id,
    //         'post_id' => $postId,
    //         'parent_comment_id' => $parentId,
    //         'comment' => $this->replyComment
    //     ]);

    //      $this->reset(['replyComment']);
    //      $this->loadNestedComments();
    // }

    public function render()
    {
        return view('livewire.portal.post-nested-comments');
    }
}
