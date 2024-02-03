<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'comment', 'parent_comment_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nestedComments()
    {
        return $this->hasMany(PostComment::class, 'parent_comment_id');
    }

    public function parentComment()
    {
        return $this->belongsTo(PostComment::class);
    }
}
