<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReadmeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome', ['posts' => Post::count()]);
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
Route::resource('comments', CommentController::class)->only(['edit', 'destroy']);

// Dashboard (Requires Authentication & Authorization)
Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth', 'can:access-dashboards'])
    ->name('dashboard');

// Readme Route (Conditionally Loaded)
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

// Authentication Routes
require __DIR__.'/auth.php';
