<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Home Page
    public function index()
    {
        return view('frontend.homepage');
    }

    // Debates Page
    public function debates()
    {
        return view('frontend.debates');
    }

    // Leaderboard Page
    public function leaderboard()
    {
        return view('frontend.leaderboard');
    }

    // Community Page
    public function community()
    {
        return view('frontend.community');
    }

    // Contact Page
    public function contact()
    {
        return view('frontend.contact');
    }

    // Debate Room Page
    public function room()
    {
        return view('frontend.room');
    }

    // Create Debate Page
    public function createDebate()
    {
        return view('frontend.create_debate');
    }
}