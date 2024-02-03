<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use App\Models\Post;
use App\Models\PostComment;
use Auth;

class PostComments extends Component
{
    public $post;
    public $comments = [];
    public $totalParentComments;
    public $perPage = 2;
    public $nestedPerPage = 2;
    public $comment = null;
    public $replyComment = null;

    protected $listeners = ['loadComments'];


    public function mount(Post $post)
    {
        $this->post = $post;
        // $this->totalComments = $this->post->postComments->count();
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->post->postParentComments()->latest()->take($this->perPage)->get();
        $this->totalParentComments = $this->post->postParentComments()->count();

        // foreach ($this->comments as $comment) {
        //     $comment->load(['nestedComments' => function ($query) {
        //         $query->latest()->paginate($this->nestedPerPage);
        //     }]);
        // }
    }

    public function hideComments()
    {
        //
    }

    public function loadMore()
    {
        $this->perPage += 1;
        $this->loadComments();
    }


    public function postComment($postId, $parentId = null)
    {

        $commentText = $this->comment ?? $this->replyComment;
        $resetField = $parentId ? 'replyComment' : 'comment';

        $validated = $this->validate([
            $resetField => 'required|min:3',
        ], [
            $resetField.'.required' => 'The field is required.'
        ]);

        PostComment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $postId,
            'parent_comment_id' => $parentId,
            'comment' => $commentText
        ]);

        // $this->totalComments += 1;

        $this->loadComments();
        $this->dispatch('loadNestedComments');
        $this->dispatch('commentAdded', $postId);
        $this->reset($resetField);
    }

    public function render()
    {
        return view('livewire.portal.post-comments');
    }
}
