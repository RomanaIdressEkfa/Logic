<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/debates', 'debates')->name('debates');
    Route::get('/leaderboard', 'leaderboard')->name('leaderboard');
    Route::get('/community', 'community')->name('community');
    Route::get('/contact', 'contact')->name('contact');
    
    Route::get('/login', 'login')->name('login'); 
    Route::post('/login', 'authenticate')->name('login.submit');
    
    Route::get('/debate/room', 'room')->name('debate.room');
    Route::get('/create-debate', 'createDebate')->name('debate.create');
    Route::get('/profile', 'profile')->name('profile');
});


Route::get('/admin/login', function () { return view('admin.login'); })->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('admin/dashboard');
    }
    return back()->withErrors([
        'email' => 'Invalid admin credentials.',
    ]);
})->name('admin.authenticate');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});