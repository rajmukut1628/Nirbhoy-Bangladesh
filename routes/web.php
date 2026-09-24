<?php

use App\Livewire\Public\Report\Create as PublicReportCreate;
use App\Livewire\Admin\Auth\Login as AdminLogin;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])
    ->name('home');Route::get('/report', PublicReportCreate::class)
    ->name('report.create');


/*
| Admin Login
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', AdminLogin::class)
        ->name('admin.login');
});


/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', AdminDashboard::class)
            ->name('dashboard');

        Route::post('/logout', function () {

            Auth::logout();

            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('home');

        })->name('logout');
    });