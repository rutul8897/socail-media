<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'caption'];

    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postParentComments()
    {
        return $this->hasMany(PostComment::class)->whereNull('parent_comment_id')->with('nestedComments');
    }

    public function postComments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function hasUserLikePost($postId)
    {
        return $this->postLikes()->where('post_id', $postId)->where('user_id', Auth::id())->exists();
    }
}
