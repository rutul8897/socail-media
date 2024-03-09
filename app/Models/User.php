<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getPhotoAttribute($value)
    {
        return $value ? asset('storage/' .$value) :  asset('images/default-user.png');
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'following_id');
    }

    public function followings()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }

    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id')
    //         ->withPivot(['status', 'is_accepted_follower']);
    // }

    // public function following()
    // {
    //     return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id')
    //         ->withPivot(['status', 'is_accept_following']);
    // }


    // public function acceptFollower(User $follower)
    // {
    //     $this->followers()->updateExistingPivot($follower->id, ['status' => 'accepted']);
    //     $follower->following()->attach($this->id, ['status' => 'accepted']);
    // }
    //     followers: This represents the users who are following the current user.
    // following: This represents the users whom the current user is following.
    // public function rejectFollower(User $follower)
    // {
    //     $this->followers()->detach($follower->id);
    //     $follower->following()->detach($this->id);
    // }

    public function hasFollowRequestFrom($userId)
    {
        return $this->followings()
        ->where('status', 'requested')
        ->where('follower_id', $userId)
        ->where('following_id', Auth::id())
        ->exists();
        // return $this->followers->where('follower_id', $userId)->where('status', 'requested')->where('is_accepted_following', 0)->isNotEmpty() ? 1 : 0;
    }

    public function hasAcceptedFollowRequestFrom($userId)
    {
        return $this->followings()
        ->where('status', 'accept')
        ->where('follower_id', $userId)
        ->where('following_id', Auth::id())
        ->where('is_accepted_follower', 1)
        ->exists();
    }

    public function hasFollowBackFollowRequestFrom($userId)
    {
        return $this->followings()
        ->where('status', 'follow_back')
        ->where('follower_id', $userId)
        ->where('following_id', Auth::id())
        ->where('is_accepted_follower', 1)
        ->exists();
    }

    public function hasSentFollowRequest($userId)
    {
        return $this->followers()
        ->where('status', 'requested')
        ->where('follower_id', Auth::id())
        ->where('following_id', $userId)
        ->exists();
    }

    public function hasAcceptFollowRequest($userId)
    {
        return $this->followers()
        ->where('status', 'accept')
        ->where('follower_id', Auth::id())
        ->where('following_id', $userId)
        ->exists();
    }

    public function hasReceivedFollowBackRequest($userId)
    {
        return $this->followers()
        ->where('status', 'follow_back')
        ->where('follower_id', Auth::id())
        ->where('following_id', $userId)
        ->exists();
    }

    public function hasFollowing($userId)
    {
        // dd(Auth::user()->followers);
        return Auth::user()->followings->where('follower_id', $userId);
    }

    public function hasAcceptedFollowing($userId)
    {
        return $this->followings()
        ->where('status', 'accepted')
        ->where('follower_id', $userId)
        ->where('following_id', Auth::id())
        ->where('is_accepted_following', 1)
        ->exists();
    }

    public function hasAcceptedFollower($userId)
    {
        return Auth::user()->followings()
        ->where('status', 'accepted')
        ->where('following_id', $userId)
        ->where('follower_id', Auth::id())
        ->where('is_accepted_follower', 1)
        ->exists();
    }
    //
    // public function hasFollowRequestFrom($userId)
    // {
    //     return $this->relationQuery('followings', 'requested', $userId);
    // }

    // public function hasAcceptedFollowRequestFrom($userId)
    // {
    //     return $this->relationQuery('followings', 'accept', $userId, 'is_accepted_follower', 1);
    // }

    // public function hasFollowBackFollowRequestFrom($userId)
    // {
    //     return $this->relationQuery('followings', 'follow_back', $userId, 'is_accepted_follower', 1);
    // }

    // public function hasSentFollowRequest($userId)
    // {
    //     return $this->relationQuery('followers', 'requested', $userId, 'is_accepted_following', 0);
    // }

    // public function hasAcceptFollowRequest($userId)
    // {
    //     return $this->relationQuery('followers', 'accept', $userId);
    // }

    // public function hasReceivedFollowBackRequest($userId)
    // {
    //     return $this->relationQuery('followers', 'follow_back', $userId);
    // }

    // public function hasFollowing($userId)
    // {
    //     return Auth::user()->followings->where('follower_id', $userId);
    // }

    // public function hasAcceptedFollowing($userId)
    // {
    //     return $this->relationQuery('followings', 'accepted', $userId, 'is_accepted_following', 1);
    // }

    // public function hasAcceptedFollower($userId)
    // {
    //     return Auth::user()->followings()->where('status', 'accepted')->where('follower_id', Auth::id())->where('is_accepted_follower', 1)->exists();
    // }

    // private function relationQuery($relation, $status, $userId, $additionalCondition = null, $additionalValue = null)
    // {
    //     $query = $this->$relation()->where('status', $status)->where('follower_id', $userId)->where('following_id', Auth::id());

    //     if ($additionalCondition !== null) {
    //         $query->where($additionalCondition, $additionalValue);
    //     }

    //     return $query->exists();
    // }
}
