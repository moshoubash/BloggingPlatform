<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PremiumController extends Controller
{
    public function index() {
        $premiumUsers = User::whereNotNull('stripe_customer_id')->get();
        $premiumPosts = Post::where('is_premium', true)->get();

        return view('dashboard.premium.index', compact('premiumUsers', 'premiumPosts'));
    }
}
