<?php

use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\PublicNoticeController;
use App\Http\Controllers\userAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Authentication routes
Route::get('/register', [userAuthenticationController::class, 'userRegister'])->name('user.register');
Route::post('/register', [userAuthenticationController::class, 'userRegisterSubmit'])->name('user.register.submit');
Route::get('/login', [userAuthenticationController::class, 'userLogin'])->name('user.login');
Route::post('/login', [userAuthenticationController::class, 'userLoginSubmit'])->name('user.login.submit');
Route::post('/logout', [userAuthenticationController::class, 'userLogout'])->name('user.logout');

// Admin routes
Route::get('/admin/dashboard', [userAuthenticationController::class, 'adminDashboard'])->name('admin.dashboard');

// User routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

// News routes
Route::get('/create-post', [NewsPostController::class, 'createPost'])->name('news.create-post');
Route::post('submit-post', [NewsPostController::class, 'submitPost'])->name('posts.submit');
Route::get('/news', [NewsPostController::class, 'newsCategoryList'])->name('news');
//Route::get('/news/details', [NewsPostController::class, 'newDetails'])->name('news-details');

// posts routes
Route::post('/pending/posts', [NewsPostController::class, 'listPendingPosts'])->name('admin-pending-posts');
Route::get('/post/{slug}', [NewsPostController::class, 'showPostDetails'])->name('post.details');
Route::post('/approve/post/{slug}', [NewsPostController::class, 'approvePost'])->name('admin.approve-post');
Route::delete('/delete/post/{slug}', [NewsPostController::class, 'deletePost'])->name('admin.delete-post');
Route::get('/published/posts', [NewsPostController::class, 'listPublishedPosts'])->name('posts.published');
Route::get('/fetch-categories', [NewsPostController::class, 'listCategoriesFromAPI']);

// public notice routes
Route::get('/create/public-notice', [PublicNoticeController::class, 'createPost'])->name('public-notice.create');
Route::post('/submit/public-notice', [PublicNoticeController::class, 'submitPost'])->name('public-notice.submit');



// ctaegory and tag routes
Route::get('/create-category', [NewsPostController::class, 'createCategory'])->name('create-category');
Route::post('/submit-category', [NewsPostController::class, 'submitCategory'])->name('submit-category');
Route::get('/create-tag', [NewsPostController::class, 'createTag'])->name('create-tag');
Route::post('/submit-tag', [NewsPostController::class, 'submitTag'])->name('submit-tag');
