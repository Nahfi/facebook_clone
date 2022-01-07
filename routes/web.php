<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Dash_Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Profile_Controller;


//guest route

Route::group(["middleware"=>"test"],function(){

  
    Route::get('/', function () {
        return view('welcome');
    })->name('shome');
    Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
    Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('/login', [LoginController::class,'login'])->name("User-log-in");
    Route::post('/register', [Profile_Controller::class,'register']);
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

  
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

// Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
/* Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // v5.x */
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});







    
//protected route
Route::group(["middleware"=>"auth"],function(){


    Route::get('/dash',[Dash_Controller::class,"dash"])->name("dashboard");
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::resource('/post', PostController::class);
    Route::resource('/profile', Profile_Controller::class);
    Route::post('/like', [Dash_Controller::class,"like"])->name("like");
    Route::post('/comment', [CommentController::class,"comment"])->name("comment");
});






