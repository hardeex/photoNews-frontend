<?php

use App\Http\Controllers\CaveatController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\PublicNoticeController;
use App\Http\Controllers\userAuthenticationController;
use App\Http\Controllers\MisplaceAndFoundController;
use App\Http\Controllers\MissingPersonController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObituaryController;
use App\Http\Controllers\RemembranceController;
use App\Http\Controllers\changeOfNameController;



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

// misplaced and found routes
Route::get('/create/misplaced-and-found', [MisplaceAndFoundController::class, 'createPost'])->name('misplaced.create');
Route::post('/submit/misplaced-and-found', [MisplaceAndFoundController::class, 'submitPost'])->name('misplaced-and-found.submit');


// missing person routes
Route::get('/create/missing-person', [MissingPersonController::class, 'createPost'])->name('missing.create');
Route::post('/submit/missing-and-wanted-person', [MissingPersonController::class, 'submitPost'])->name('missing-person.submit');

// obituary routes
Route::get('/create/obituary', [ObituaryController::class, 'createPost'])->name('obituary.create');
Route::post('/submit/obituary', [ObituaryController::class, 'submitPost'])->name('obituary.submit');

// remebrance controller
Route::get('/create/remembrance', [RemembranceController::class, 'createPost'])->name('remembrance.create');
Route::post('/submit/remembrance', [RemembranceController::class, 'submitPost'])->name('remembrance.submit');


// change of name routes
Route::get('/create-change-of-name', [changeOfNameController::class, 'createPost'])->name('change-of-name.create');
Route::post('/submit-change-of-name', [changeOfNameController::class, 'submitPost'])->name('change-of-name.submit');


// caveat routes
Route::get('/create/caveat', [CaveatController::class, 'createPost'])->name('caveat.create');
Route::post('/submit/caveat', [CaveatController::class, 'submitPost'])->name('caveat.submit');



// ctaegory and tag routes
Route::get('/create-category', [NewsPostController::class, 'createCategory'])->name('create-category');
Route::post('/submit-category', [NewsPostController::class, 'submitCategory'])->name('submit-category');
Route::get('/create-tag', [NewsPostController::class, 'createTag'])->name('create-tag');
Route::post('/submit-tag', [NewsPostController::class, 'submitTag'])->name('submit-tag');


// seeder category routes
Route::get('/create-category-seeder', [NewsPostController::class, 'createCategorySeeder'])->name('create-category-seeder');
Route::post('/submit-category-seeder', [NewsPostController::class, 'submitCategorySeeder'])->name('submit-category-seeder');