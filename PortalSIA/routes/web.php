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



// ========== NEWS ========== //
Route::get('/news', function () {
    return view('news');
});



// ========== ADMIN SECTION ========== //
Route::middleware(['auth', 'auth.role:0'])->group(function ()
{
    // ========== DASHBOARD LIVEWIRE ========== //
    Route::controller(\App\Http\Livewire\Admin\Dashboard::class)->group(function()
    {
        Route::get('/dashboard-admin', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard-admin');
    });
});



// ========== TEACHER SECTION ========== //
Route::group(['prefix' => 'teacher'], function ()
{
    Route::name('teacher.')->group(function ()
    {
        Route::middleware(['auth', 'auth.role:1'])->group(function ()
        {
            // ========== DASHBOARD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\Dashboard::class)->group(function()
            {
                Route::get('/dashboard', \App\Http\Livewire\Teacher\Dashboard::class)->name('dashboard');
            });

            // ========== PROFILE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\Profile::class)->group(function()
            {
                Route::get('/profile', \App\Http\Livewire\Teacher\Profile::class)->name('profile');

                // ========== UPDATE PROFILE PICTURE ========== //
                Route::post('/update-profile-picture', "UpdateProfilePicture")->name('update-profile-picture');
            });

            // ========== HOMEROOM CLASS LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\HomeroomClass::class)->group(function()
            {
                Route::get('/homeroom-class', \App\Http\Livewire\Student\HomeroomClass::class)->name('homeroom-class');
            });
        });
    });
});



// ========== STUDENT SECTION ========== //
Route::group(['prefix' => 'student'], function ()
{
    Route::name('student.')->group(function ()
    {
        Route::middleware(['auth', 'auth.role:2'])->group(function ()
        {
            // ========== DASHBOARD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\Dashboard::class)->group(function()
            {
                Route::get('/dashboard', \App\Http\Livewire\Student\Dashboard::class)->name('dashboard');
            });

            // ========== PROFILE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\Profile::class)->group(function()
            {
                Route::get('/profile', \App\Http\Livewire\Student\Profile::class)->name('profile');

                // ========== UPDATE PROFILE PICTURE ========== //
                Route::post('/update-profile-picture', "UpdateProfilePicture")->name('update-profile-picture');
            });

            // ========== HOMEROOM CLASS LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\HomeroomClass::class)->group(function()
            {
                Route::get('/homeroom-class', \App\Http\Livewire\Student\HomeroomClass::class)->name('homeroom-class');
            });
        });
    });
});