<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\PageView;

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
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $profileImagePath;
        }

        if ($request->hasFile('cover_image')) {
            $profileCoverPath = $request->file('cover_image')->store('cover_images', 'public');
            $user->cover_image = $profileCoverPath;
        }

        $user->update($request->except(['profile_image', 'cover_image']));

        return redirect()->route('profile', ['user' => $user])->with('success', 'Profile updated successfully.');
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
            'cover_image' => $user->cover_image,
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

        $notification = Notification::create([
            'type' => 'Follow',
            'user_id' => $user->id,
            'content' => Auth::user()->name . " Started following you!",
        ]);

        $notification->timestamps = false;
        $notification->save();

        return back();
    }

    /**
     * Show the bookmarks of the user.
     */
    public function bookmarks(User $user)
    {
        $userBookmarks = Bookmark::where('user_id', $user->id)
            ->with('post')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.bookmarks', [
            'bookmarkedPosts' => $userBookmarks,
            'user' => $user,
        ]);
    }

    public function stats()
    {
        $user = Auth::user();
        $postsCount = Post::where('user_id', $user->id)->count();
        $followersCount = Follower::where('followed_id', $user->id)->count();
        $followingCount = Follower::where('follower_id', $user->id)->count();

        $userPosts = Post::where('user_id', $user->id)->get();
        $viewsCount = 0;
        foreach ($userPosts as $post) {
            $post_url = '/posts/' . $post->slug;
            $viewsCount += PageView::where('page', $post_url)->count();
        }

        $currentDay = now()->startOfDay();
        $weekDays = [];
        $postsPerDay = [];

        for ($i = 0; $i < 7; $i++) {
            $day = $currentDay->copy()->subDays($i);
            $weekDays[] = $day->format('l'); // Get the day name
            $postsPerDay[] = Post::where('user_id', $user->id)
            ->whereDate('created_at', $day)
            ->count();
        }

        $weekDays = array_reverse($weekDays);
        $postsPerDay = array_reverse($postsPerDay);

        return view('user.stats', [
            'postsCount' => $postsCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
            'viewsCount' => $viewsCount,
            'user' => $user,
            'days' => $weekDays,
            'postsPerDay' => $postsPerDay,
        ]);
    }
}
