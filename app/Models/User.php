<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\PostView;
use App\Models\Role;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'name', 'bio', 'role_id', 'google_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'is_author' => 'boolean',
        'is_banned' => 'boolean',
    ];

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function postViews()
    {
        return $this->hasMany(PostView::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'followed_id');
    }
}
