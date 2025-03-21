<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegisterController;
use App\Mail\ClientPasswordMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisterController::class,'view']);
    Route::post('/register',[RegisterController::class, 'store'])->name('register');
    Route::get('/login',[AuthController::class, 'view'])->name('loginView');
    Route::post('/login',[AuthController::class, 'store'])->name('login');
});

Route::middleware('auth')->group(function(){
    Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::resource('/client',ClientController::class);
});

