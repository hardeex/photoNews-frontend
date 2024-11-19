<?php

use App\Http\Controllers\userAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Generic routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/news', [USerController::class, 'newsCategoryList'])->name('news');
Route::get('/news/details', [UserController::class, 'newDetails'])->name('news-details');

// Authentication routes
Route::get('/register', [userAuthenticationController::class, 'userRegister'])->name('user.register');
Route::post('/register', [userAuthenticationController::class, 'userRegisterSubmit'])->name('user.register.submit');
Route::get('/login', [userAuthenticationController::class, 'userLogin'])->name('user.login');
Route::post('/login', [userAuthenticationController::class, 'userLoginSubmit'])->name('user.login.submit');
Route::get('/logout', [userAuthenticationController::class, 'userLogout'])->name('user.logout');

// User routes
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
