<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing-page');
})->name('landing-page');



// ========== School Events List Page ========== //
Route::get('/events', function () {
    return view('school-events');
});

Route::get('/full-events', function () {
    return view('full-school-events');
});

Route::get('/visimisi', function () {
    return view('visimisi');
});

Route::get('/full-profile', function () {
    return view('school-profile');
});


// ========== LOGIN PAGE FOR NON AUTHENTICATED USERS ========== //

Route::group(['controller' => 'App\Http\Controllers\Auth\LoginController'], function ()
{
    Route::get('/login', 'DisplayForm')->name("login")->middleware('guest');
    Route::post('/post-login', 'Login')->name('post-login');
});



// ========== LOGOUT FUNCTION FOR AUTHENTICATED USERS ========== //
Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@Logout');