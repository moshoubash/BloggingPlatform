<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReadmeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Models\Post;

// Home Route
Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome', ['posts' => Post::count()]);
    }
    return view('landing');
})->name('home');

// Google Authentication
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Posts Routes
Route::resource('posts', PostController::class);
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
    Route::post('/posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');
});

// Comments Routes
Route::resource('comments', CommentController::class);

// Dashboard (Requires Authentication & Authorization)
Route::get('/dashboard/overview', [DashboardController::class, 'show'])
    ->middleware(['auth', 'can:access-dashboards'])
    ->name('dashboard');

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
Route::post('/users/{user}/follow', [UserController::class, 'toggleFollow'])->middleware(['auth'])->name('users.follow');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->middleware(['auth'])->name('user.edit');
Route::put('/user/update/{user}', [UserController::class, 'update'])->middleware(['auth'])->name('user.update');

Route::post('/user/delete/{user}', [UserController::class, 'destroy'])->middleware(['auth'])->name('user.destroy');

Route::post('/posts/{post}/like', [PostController::class, 'like'])->middleware(['auth'])->name('posts.like');
Route::post('/posts/{post}/bookmark', [PostController::class, 'bookmark'])->middleware(['auth'])->name('posts.bookmark');
Route::get('/user/{user}/bookmarks', [UserController::class, 'bookmarks'])->middleware(['auth'])->name('bookmarks.index');

Route::patch('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->middleware(['auth'])->name('notifications.markAsRead');
Route::get('/user/stats', [UserController::class, 'stats'])->middleware(['auth'])->name('user.stats');

if (config('blog.readme')) {
    Route::get('/readme', [ReadmeController::class, '__invoke'])->name('readme');
}

// Stripe Checkout Routes
Route::middleware('auth')->prefix('checkout')->group(function () {
    Route::get('/', [PaymentController::class, 'checkout'])->name('checkout'); // Displays checkout page
    Route::post('/process', [PaymentController::class, 'process'])->name('checkout.process'); // Processes Stripe payment
    Route::get('/success', [PaymentController::class, 'success'])->name('checkout.success'); // Handles payment success
    Route::get('/cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel'); // Handles payment cancellation
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

Route::get("/home", function () {
    return view('welcome');
})->middleware('auth');

// Dashboard Routes
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    // Users Management
    Route::get('/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/users/edit/{user}', [UserController::class, 'dashboardEdit'])->name('dashboard.users.edit');
    Route::put('/users/edit/{user}', [UserController::class, 'dashboardUpdate'])->name('dashboard.users.update');
    
    // Posts Management
    Route::get('/posts', [PostController::class, 'dashboardPosts'])->name('dashboard.posts.index');
    Route::get('/posts/edit/{post}', [PostController::class, 'dashboardEdit'])->name('dashboard.posts.edit');
    Route::put('/posts/edit/{post}', [PostController::class, 'dashboardUpdate'])->name('dashboard.posts.update');
    Route::post('/posts/destroy/{post}', [PostController::class, 'dashboardDestroy'])->name('dashboard.posts.destroy');
    
    // Comments Management
    Route::get('/comments', [CommentController::class, 'comments'])->name('dashboard.comments.index');
    Route::post('/comments/destroy/{comment}', [CommentController::class, 'dashboardDestroy'])->name('dashboard.comments.destroy');
    
    // Premium Management
    Route::get('/premium', [PremiumController::class, 'index'])->name('dashboard.premium.index');
    
    // Notifications Management
    Route::get('/notifications', function () {
        return view('dashboard.notifications.index');
    })->name('dashboard.notifications.index');
    
    // Reports Management
    Route::get('/reports', function () {
        return view('dashboard.reports.index');
    })->name('dashboard.reports.index');
    
    // Statistics and Analytics
    Route::get('/statistics', function () {
        return view('dashboard.statistics.index');
    })->name('dashboard.statistics.index');

    // ✅ Tags Management (moved here)
    Route::get('/tags', [TagController::class, 'index'])->name('dashboard.tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('dashboard.tags.store');
    Route::put('/tags/{id}', [TagController::class, 'update'])->name('dashboard.tags.update');
    Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('dashboard.tags.destroy');

    // Account Settings
    Route::get('/account', function () {
        return view('dashboard.account.index');
    })->name('dashboard.account.index');

    // Blog Settings
    Route::get('/site/settings', function () {
        return view('dashboard.site.index');
    })->name('dashboard.site.index');
});

// Removed the old /admin routes block since tag management is now under dashboard

require __DIR__.'/auth.php';
