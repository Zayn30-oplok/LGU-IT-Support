<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('session.auth:guest');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store')
    ->middleware('session.auth:guest');


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
|
| Everything inside this group requires the user to be logged in.
|
*/

Route::middleware('session.auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Client Routes (staff / barangay)
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [PageController::class, 'dashboard'])
        ->middleware('not.admin')
        ->name('dashboard');

    Route::prefix('tickets')
        ->name('tickets.')
        ->middleware('not.admin')
        ->group(function () {

            Route::get('/', [PageController::class, 'tickets'])
                ->name('index');

        });

    Route::get('/knowledge', [PageController::class, 'knowledge'])
        ->middleware('not.admin')
        ->name('knowledge');

    Route::get('/notifications', [PageController::class, 'notifications'])
        ->middleware('not.admin')
        ->name('notifications');

    Route::get('/profile', [PageController::class, 'profile'])
        ->middleware('not.admin')
        ->name('profile');

    Route::get('/settings', [PageController::class, 'settings'])
        ->middleware('not.admin')
        ->name('settings');

    Route::get('/history', [PageController::class, 'history'])
        ->middleware('not.admin')
        ->name('history');


    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    | Everything admin-related lives under /admin.
    |
    */

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {

            Route::get('/dashboard', [PageController::class, 'adminDashboard'])
                ->name('dashboard');

            Route::prefix('tickets')
                ->name('tickets.')
                ->group(function () {

                    Route::get('/', [PageController::class, 'adminTickets'])
                        ->name('index');

                });

            Route::get('/knowledge', [PageController::class, 'adminKnowledge'])
                ->name('knowledge');

            Route::get('/notifications', [PageController::class, 'adminNotifications'])
                ->name('notifications');

            Route::get('/profile', [PageController::class, 'adminProfile'])
                ->name('profile');

            Route::get('/settings', [PageController::class, 'adminSettings'])
                ->name('settings');

            Route::get('/history', [PageController::class, 'adminHistory'])
                ->name('history');

            Route::get('/staff', [PageController::class, 'staff'])
                ->name('staff');

            Route::get('/staff/staff_information', 
                [StaffController::class, 'staffInformation'])
            ->name('staff.staff_information');
            Route::get('/staff/staff_archives',
                [StaffController::class, 'staffArchives'])
            ->name('staff.staff_archives');

            Route::get('/barangays', [PageController::class, 'barangays'])
                ->name('barangays');

            Route::get('/departments', [PageController::class, 'departments'])
                ->name('departments');

            Route::get('/services', [PageController::class, 'services'])
                ->name('services');

            Route::get('/reports', [PageController::class, 'reports'])
                ->name('reports');

        });

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| 404 Fallback
|--------------------------------------------------------------------------
|
| IMPORTANT:
| This is OUTSIDE the authentication middleware.
|
| Therefore:
|
| Existing protected URL + not logged in = 401
| Non-existing URL = 404
|
*/

Route::fallback([PageController::class, 'notFound']);
