<?php

use Illuminate\Support\Facades\Route;





// ========== LANDING PAGE ========== //
Route::group(['controller' => 'App\Http\Livewire\LandingPage'], function ()
{
    Route::get('/', 'App\Http\Livewire\LandingPage'::class)->name('landing-page');
});



// ========== LOGIN PAGE FOR GUESTS ========== //
Route::group(['controller' => 'App\Http\Livewire\Auth\Login'], function ()
{
    Route::get('/login', App\Http\Livewire\Auth\Login::class)->name("login")->middleware('guest');
    Route::post('/post-login', 'Login')->name('post-login');
});




// ========== LOGOUT FUNCTION FOR AUTHENTICATED USERS ========== //
Route::post('/logout', 'App\Http\Livewire\Auth\Logout@Logout');



// ========== SCHOOL EVENTS ========== //
Route::get('/news', function () {
    return view('news');
});



// ========== ADMIN DASHBOARD FOR AUTHENTICATED USERS WITH ROLE AS ADMIN ========== //
Route::middleware(['auth', 'auth.role:0'])->group(function ()
{
    // ========== DASHBOARD LIVEWIRE ========== //
    Route::controller(\App\Http\Livewire\Admin\Dashboard::class)->group(function()
    {
        Route::get('/dashboard-admin', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard-admin');
    });
});



// ========== STUDENT DASHBOARD FOR AUTHENTICATED USERS WITH ROLE AS STUDENT ========== //
Route::middleware(['auth', 'auth.role:2'])->group(function ()
{
    // ========== DASHBOARD LIVEWIRE ========== //
    Route::controller(\App\Http\Livewire\Student\Dashboard::class)->group(function()
    {
        Route::get('/dashboard-student', \App\Http\Livewire\Student\Dashboard::class)->name('dashboard-student');
    });

    // ========== PROFILE LIVEWIRE ========== //
    Route::controller(\App\Http\Livewire\Student\Profile::class)->group(function()
    {
        Route::get('/profile', \App\Http\Livewire\Student\Profile::class)->name('student-profile');
    });
});