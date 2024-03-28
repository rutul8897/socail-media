<?php

namespace App\Livewire\Portal;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\User;
use App\Models\PostComment;
use App\Models\PostLike;
use File;
use Auth;

class Home extends Component
{
    use WithFileUploads;

    public $caption = '';
    public $photos = [];
    // public $comment = '';
    public $perPage = 3;
    public $searchTerm = '';
    // public $posts = [];

    public $totalLikes = 0;

    protected $listeners = ['commentAdded', 'updateLikes', 'refresh-me' => '$refresh'];


    // public function mount()
    // {
    //     \Log::info('mount called');
    //     $this->loadPots();
    // }

    // public function loadPots()
    // {
    //     $this->posts = Post::with('postComments', 'postLikes')->latest()->get();
    // }

    public function loadMorePost()
    {
        $this->perPage += 5;
    }

    public function savePost()
    {
        // try {
            $validated = $this->validate([
                'caption' => 'required|min:3',
                'photos' => 'required',
                'photos.*' => 'image|mimes:png,jpg,jpeg|max:2048', // 2MB Max
            ], [
                'photos.required' => 'Please upload a file',
                'photos.*.mimes' => 'Please upload a valid file (Allowed file png,jpg,jpeg)',
                'photos.*.max' => 'The uploaded file size is too large. Max allowed size 2MB',
            ]);

            $post = Post::create([
                'user_id' => Auth::user()->id,
                'caption' => $this->caption
            ]);

            foreach ($this->photos as $photo) {
                // dd($photo->getClientOriginalName(), $photo->getClientOriginalExtension(), );

                $path = $photo->store('post-images', 'public');

                $temporaryFilePath = $photo->getRealPath();

                // Delete the temporary file
                if (File::exists($temporaryFilePath)) {
                    File::delete($temporaryFilePath);
                }

                PostImage::create([
                    'post_id' => $post->id,
                    'image' => $path
                ]);

                // $destinationPath = 'uploads';
                // $photo->move($destinationPath, $photo->getClientOriginalName());
            }

            $this->reset(['caption', 'photos']);
             // $this->posts->prepend($post);
             // $this->loadPots();
            // $this->posts[] = $post;
             // $this->dispatch('refresh-me')->self();
            // dd($this->posts);
            // $post->load('postComments');

        // } catch (\Exception $e) {
        //     session()->flash('error', 'Unable to uploaded file. Please try again');
        // }
    }

    // public function saveComment($postId, $parentId = null)
    // {
    //     PostComment::create([
    //         'user_id' => Auth::user()->id,
    //         'post_id' => $postId,
    //         'parent_comment_id' => $parentId,
    //         'comment' => $this->comment
    //     ]);

    //      $this->reset();
    // }

    // public function loadMoreComments($postId)
    // {
    //     return PostComment::wherePostId($postId)->skip(2)->take(1)->get();
    // }
    //

    public function postLikeDislike($postId)
    {
        $postLike =  PostLike::where([
            'post_id' => $postId,
            'user_id' => Auth::id()
        ])->first();

        if ($postLike) {
            $postLike->delete();
            $this->isLiked = false;
        } else {
            PostLike::create([
                'post_id' => $postId,
                'user_id' => Auth::id()
            ]);
            $this->isLiked = true;
        }

         // $this->dispatch('updateLikes', $this->postId);
         $this->updateLikes($postId);
    }

    public function commentAdded($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->load('postComments');
        }
    }

    public function updateLikes($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->load('postLikes');
        }
    }

    public function render()
    {
        $followingUserIds = Auth::user()->followings()->pluck('following_id')->toArray();
        $followerUserIds = Auth::user()->followers()->pluck('follower_id')->toArray();
        $postUserIds = array_merge($followerUserIds, $followingUserIds, [Auth::id()]);
        $posts = Post::with('postComments', 'postLikes')->when($this->searchTerm != '', function ($q) {
            $q->where('caption', 'like', $this->searchTerm);
        })->whereIn('user_id', $postUserIds)->latest()->take($this->perPage)->get();
        // $posts = Post::with('postComments', 'postLikes')->latest()->get();

        return view('livewire.portal.home', [
            'posts' => $posts
        ])->layout('components.layouts.portal-app');
    }

    // public function showCommentModal($post)
    // {
    //     \Log::info('show');
    //     $this->dispatch('showComment', $post);
    // }
}
