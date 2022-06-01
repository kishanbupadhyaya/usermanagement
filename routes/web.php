<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;

// Front Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\UserController as Profile;

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
    return view('welcome');
});

Auth::routes();

Route::get('/verify-email', [VerificationController::class, 'verify'])->name('verify');
Route::post('/verify-email', [VerificationController::class, 'verifyOTP'])->name('verify.otp');

// Verified User will access all pages other user can't
Route::group(['middleware' => 'verify_user'], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [Profile::class, 'index'])->name('profile');
});

Route::group(['prefix' => 'admin'], function() {

    // Login Routes
    Route::get('/login', [AdminController::class, 'index'])->name('admin.login');
    Route::post('/admin_login', [AdminController::class, 'login'])->name('admin.signin');


    // For admin middlewares
    Route::group(['middleware' => 'admin'], function(){

        // auth roots
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Users
        Route::resource('/users', UserController::class);
    });
});
