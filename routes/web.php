<?php

use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\userAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Authentication routes
Route::get('/register', [userAuthenticationController::class, 'userRegister'])->name('user.register');
Route::post('/register', [userAuthenticationController::class, 'userRegisterSubmit'])->name('user.register.submit');
Route::get('/login', [userAuthenticationController::class, 'userLogin'])->name('user.login');
Route::post('/login', [userAuthenticationController::class, 'userLoginSubmit'])->name('user.login.submit');
Route::get('/logout', [userAuthenticationController::class, 'userLogout'])->name('user.logout');

// User routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

// News routes
Route::get('/create-post', [NewsPostController::class, 'createPost'])->name('news.create-post');
Route::get('/news', [NewsPostController::class, 'newsCategoryList'])->name('news');
Route::get('/news/details', [NewsPostController::class, 'newDetails'])->name('news-details');


// ctaegory routes
Route::get('/create-category', [NewsPostController::class, 'createCategory'])->name('create-category');
Route::post('/submit-category', [NewsPostController::class, 'submitCategory'])->name('submit-category');