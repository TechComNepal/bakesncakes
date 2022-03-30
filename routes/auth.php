<?php

use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Notifications\UserEmailVerification;


//Logout
Route::get('logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::group(['middleware' => ['guest']], function () {
    //Register
    Route::get('register', [RegisterController::class, 'show'])->name('auth.register.show');
    Route::post('register', [RegisterController::class, 'register'])->name('auth.register.authenticate');
    //Login
    Route::get('login', [LoginController::class, 'show'])->name('auth.login.show');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login.authenticate');
    //Password
    Route::get('forgot-password', [ForgotPasswordController::class,'showForgotPasswordForm'])->name('forgot.password.show');
    Route::post('forgot-password', [ForgotPasswordController::class,'submitForgotPasswordForm'])->name('forgot.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::get('auth/{provider}', [RegisterController::class, 'redirect']);
    Route::get('auth/{provider}/callback', [RegisterController::class, 'callback']);
});

Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verifyRequestLink'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('/verify-email', [VerificationController::class, 'showVerifyEmail'])
    ->middleware('auth')
    ->name('verification.notice');

Route::post('/verify-email/request', [VerificationController::class, 'requestNewVerificationLink'])
    ->middleware('auth')
    ->name('verification.request');
