<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReadmeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Request;

// Route::get('/', [LandingPageController::class, 'index'])->name('home');
/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

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

Route::get("/home", function() {
    return view('welcome');
})->middleware('auth');

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    // Users management
    Route::get('/users', function() {
        return view('dashboard.users.index');
    })->name('dashboard.users.index');
    
    // Notifications management
    Route::get('/notifications', function() {
        return view('dashboard.notifications.index');
    })->name('dashboard.notifications.index');
    
    // Premium management
    Route::get('/premium', function() {
        return view('dashboard.premium.index');
    })->name('dashboard.premium.index');
    
    // Posts management
    Route::get('/posts', function() {
        return view('dashboard.posts.index');
    })->name('dashboard.posts.index');

    // Reports management
    Route::get('/reports', function() {
        return view('dashboard.reports.index');
    })->name('dashboard.reports.index');
    
    // Comments management
    Route::get('/comments', function() {
        return view('dashboard.comments.index');
    })->name('dashboard.comments.index');
    
    // Statistics and analytics
    Route::get('/statistics', function() {
        return view('dashboard.statistics.index');
    })->name('dashboard.statistics.index');

    // Tags Management
    Route::get('/tags', function() {
        return view('dashboard.tags.index');
    })->name('dashboard.tags.index');

    // Account Settings
    Route::get('/account', function() {
        return view('dashboard.account.index');
    })->name('dashboard.account.index');

    // Blog Settings
    Route::get('/site/settings', function() {
        return view('dashboard.site.index');
    })->name('dashboard.site.index');
});

require __DIR__.'/auth.php'; 