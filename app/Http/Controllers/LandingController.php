<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


namespace App\Http\Controllers;
use Illuminate\Http\Request;
class LandingController extends Controller
{
    /**
     * Display the landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can pass data to your view here if needed
        return view('/layouts/landing');
    }
}
