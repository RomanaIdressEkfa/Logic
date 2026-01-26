<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure you import User model
use Illuminate\Support\Facades\Hash;

class FrontendController extends Controller
{
    public function index() { return view('frontend.homepage'); }
    public function debates() { return view('frontend.debates'); }
    public function leaderboard() { return view('frontend.leaderboard'); }
    public function community() { return view('frontend.community'); }
    public function contact() { return view('frontend.contact'); }
    public function room() { return view('frontend.room'); }
    public function createDebate() { return view('frontend.create_debate'); }

    // 1. Show Login Form
    public function login()
    {
        return view('frontend.login');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role' => 'required|in:judge,pro_debater,con_debater'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => explode('@', $email)[0], 
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role, 
            ]);
            
            Auth::login($user);
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user->role = $role;
                $user->save();
            } else {
                return back()->withErrors(['email' => 'Wrong password provided.']);
            }
        }

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', "Welcome back! You are logged in as a " . ucfirst(str_replace('_', ' ', $role)));
    }
}