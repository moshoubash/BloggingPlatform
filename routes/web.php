<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReadmeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome', [
        'posts' => Post::count()
    ]);
})->name('home');

Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);


Route::resource('posts', PostController::class);
Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::post('/posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');

Route::resource('comments', CommentController::class)->only([
    'edit',
    'destroy',
]);

Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'can:access-dashboards'])->name('dashboard');

Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');
Route::post('/users/{user}/follow', [UserController::class, 'toggleFollow'])->middleware(['auth'])->name('users.follow');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->middleware(['auth'])->name('user.edit');
Route::put('/user/update/{user}', [UserController::class, 'update'])->middleware(['auth'])->name('user.update');

if (config('blog.readme')) {
    Route::get('/readme', ReadmeController::class);
}

require __DIR__.'/auth.php';
