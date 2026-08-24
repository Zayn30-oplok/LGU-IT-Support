<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing_page');
})->name('home');

/*
|--------------------------------------------------------------------------
| Login (only reachable by clicking the login buttons)
|--------------------------------------------------------------------------
|
| The Referer header tells us how the user arrived:
|   - Clicked a button on our site  -> Referer = one of our own URLs -> show login
|   - Typed the URL directly        -> no Referer                    -> back to home
|
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('session.auth:guest');
/*
|--------------------------------------------------------------------------
| Protected Pages
|--------------------------------------------------------------------------
|
| Routes here can only be opened when logged in.
| Typing their URL directly redirects back to /login.
|
*/

// Route::middleware('session.auth')->group(function () {
//     // Add protected pages here, e.g. dashboard, tickets, etc.
//     // Guests typing these URLs are redirected to /login automatically.

//     Route::get('/dashboard', function () {
//     })->name('dashboard');
// });

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
|
| Clears the logged_in flag so /login becomes accessible again.
|
*/

Route::get('/logout', function () {
    session()->forget('logged_in');

    return redirect()->route('home');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
|
| Any URL that doesn't match a route above renders the custom 404 page.
|
*/

Route::fallback(function () {
    return response()->view('error.404', [], 404);
});
