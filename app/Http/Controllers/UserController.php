<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('user.edit', [
            'user' => User::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Take the user to Profile Page.
     */
    public function profile(User $user)
    {
        return view('user.profile', [
            'user' => $user,
            'bio' => $user->bio,
            'user_id' => $user->id,
            'profile_image' => $user->profile_image,
            'profile_cover' => $user->profile_cover,
            'posts' => $user->posts,
            'userLikes' => $user->likes,
            'userFollowers' => $user->followers,
            'userFollowing' => $user->following,
            'userFollowersCount' => $user->followers()->count(),
            'userFollowingCount' => $user->following()->count(),
            'userPostsCount' => $user->posts()->count(),
            'userCommentsCount' => $user->comments()->count(),
            'userLikesCount' => $user->likes()->count(),
            'userFollowersCount' => $user->followers()->count(),
            'userFollowingCount' => $user->following()->count(),
            'isFollowing' => Auth::check() ? Auth::user()->following()->where('followed_id', $user->id)->exists() : false,
        ]);
    }

    /**
     * Following a user.
     */
    public function toggleFollow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->following()->where('followed_id', $user->id)->exists()) {
            // Unfollow the user
            $currentUser->following()->detach($user->id);
            return back()->with('success', 'You have unfollowed ' . $user->name);
        }
        // Follow the user
        $currentUser->following()->attach($user->id);

        // Create a new follower record only if it doesn't already exist
        if (!Follower::where('follower_id', $currentUser->id)->where('followed_id', $user->id)->exists()) {
            $follower = new Follower();
            $follower->follower_id = $currentUser->id;
            $follower->followed_id = $user->id;
            $follower->save();
        }

        return back();
    }
}
