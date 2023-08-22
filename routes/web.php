<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authenticated Routes
Route::middleware('auth')->group(function(){
    // User Management
    Route::resource('users', App\Http\Controllers\UserController::class);

    // To Update Users
    Route::get('/users/status/{user_id}/{status_code}', [UserController::class, 'updateStatus'])->name('users.status.update');
});

// Google URL
Route::prefix('auth/google')->name('google.')->group( function(){
    Route::get('login', [\App\Http\Controllers\GoogleController::class, 'loginWithGoogle'])->name('login');
    Route::any('call-back', [\App\Http\Controllers\GoogleController::class, 'callbackFromGoogle'])->name('call-back');
});
