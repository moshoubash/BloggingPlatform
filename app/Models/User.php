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

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;  // Removed Billable trait

    protected $fillable = [
        'username', 
        'email', 
        'password', 
        'name', 
        'bio', 
        'role_id', 
        'google_id', 
        'is_author', 
        'stripe_customer_id',  // Stripe customer ID
        'stripe_subscription_id', // Stripe subscription ID
        'stripe_plan_id',          // Stripe plan ID
    ];

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

    public function posts()
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

    // Subscription Methods (adjusted for manual checking without Cashier)
    public function hasPremiumSubscription()
    {
        return $this->stripe_subscription_id && $this->isSubscriptionActive();
    }

    public function isSubscriptionActive()
    {
        // Implement logic to check if the Stripe subscription is active
        // For example, check the subscription's status (this would require integration with Stripe API)
        return true; // This is just a placeholder
    }

    public function hasValidStripeSubscription()
    {
        return $this->stripe_subscription_id && $this->stripe_plan_id;
    }

    public function hasPremiumPlan()
    {
        return $this->stripe_plan_id === 'price_1R9mLtPrNcimFvkcWtBo6iLF'; // Use the actual Stripe premium plan Price ID
    }
}
