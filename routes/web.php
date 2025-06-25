<?php

use App\Http\Controllers\CaveatController;
use App\Http\Controllers\CelebrationController;
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
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\StolenVehicle;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Http;

// Authentication routes
Route::get('/register', [userAuthenticationController::class, 'userRegister'])->name('user.register');
Route::post('/register', [userAuthenticationController::class, 'userRegisterSubmit'])->name('user.register.submit');
Route::get('/login', [userAuthenticationController::class, 'userLogin'])->name('user.login');
Route::post('/login', [userAuthenticationController::class, 'userLoginSubmit'])->name('user.login.submit');
Route::get('/forgot-password', [userAuthenticationController::class, 'forgotPassword'])->name('password.request');
Route::post('/send-forgot-password-request', [userAuthenticationController::class, 'forgotPasswordSubmit'])->name('user.forgot-password.submit');
Route::post('/reset-password', [userAuthenticationController::class, 'resetPassword'])->name('password.email');
Route::get('/reset-password', [userAuthenticationController::class, 'resetPassword'])->name('user.reset-password');
Route::post('/reset-password', [userAuthenticationController::class, 'resetPasswordSubmit'])->name('user.reset-password.submit');
Route::post('/logout', [userAuthenticationController::class, 'userLogout'])->name('user.logout');

Route::post('/request-editor', [userAuthenticationController::class, 'requestEditorSubmit'])->name('user.request-editor');
Route::get('/manage-editor', [userAuthenticationController::class, 'manageEditor'])->name('manage-editor');
Route::post('/approve-editor/{id}', [UserAuthenticationController::class, 'approveEditor'])->name('editor.approve');
Route::post('/reject-editor/{id}', [UserAuthenticationController::class, 'rejectEditor'])->name('editor.reject');



// Admin routes
Route::get('/admin/dashboard', [userAuthenticationController::class, 'adminDashboard'])->name('admin.dashboard');

// User routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/editor/dashboard', [UserController::class, 'dashboard'])->name('editor.dashboard');
Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
Route::get('/live/videos', [NewsPostController::class, 'youtubeLink'])->name('youtube-link');
Route::post('/posts/youtube/link', [NewsPostController::class, 'submitYoutubeLink'])->name('submit-youtube-link');
Route::get('/get/youtube/links', [NewsPostController::class, 'getLiveVideos'])->name('get-live-videos');

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
Route::get('/manage/posts', [NewsPostController::class, 'managePosts'])->name('manage-posts');
Route::get('/posts/edit/{slug}', [NewsPostController::class, 'fetchPostForEdit'])->name('fetch.post.edit');
Route::put('/posts/edit/{slug}', [NewsPostController::class, 'updatePost'])->name('update.post');
Route::get('/categories-with-post', [NewsPostController::class, 'getCategories'])->name('categories.with.post');
Route::get('/categories', [UserController::class, 'ShowAllCategoryPosts'])->name('categories.all');
// Route::get('/category/post/{slug}', [UserController::class, 'showCategoryPostDetails'])->name('categories.show');
Route::get('/category/post/{slug}', [UserController::class, 'showCategoryPostDetails'])->name('categories.show');


// public notice routes
Route::get('/create/public-notice', [PublicNoticeController::class, 'createPost'])->name('public-notice.create');
Route::post('/submit/public-notice', [PublicNoticeController::class, 'submitPost'])->name('public-notice.submit');
Route::get('/lists/public-notice', [PublicNoticeController::class, 'listPublicLists'])->name('lists-public-notice');
Route::get('/posts/public-notice/{slug}', [PublicNoticeController::class, 'showPublicNoticeDetails'])->name('posts-public-notice-details');

// misplaced and found routes
Route::get('/create/misplaced-and-found', [MisplaceAndFoundController::class, 'createPost'])->name('misplaced.create');
Route::post('/submit/misplaced-and-found', [MisplaceAndFoundController::class, 'submitPost'])->name('misplaced-and-found.submit');
Route::get('/lists/lost-and-found/posts', [MisplaceAndFoundController::class, 'listLostAndFound'])->name('lists-lost-and-found');
Route::get('/misplaced/{slug}', [MisplaceAndFoundController::class, 'showPostDetails'])->name('misplaced.details');


// missing and wanted person routes
Route::get('/create/missing-person', [MissingPersonController::class, 'createPost'])->name('missing.create');
Route::post('/submit/missing-and-wanted-person', [MissingPersonController::class, 'submitPost'])->name('missing-person.submit');
Route::get('/missing-{slug}', [MissingPersonController::class, 'showPostDetails'])->name('missing-wanted.details');
Route::get('/lists/missing', [MissingPersonController::class, 'listPosts'])->name('missing-wanted-lists.details');



// obituary routes
Route::get('/create/obituary', [ObituaryController::class, 'createPost'])->name('obituary.create');
Route::post('/submit/obituary', [ObituaryController::class, 'submitPost'])->name('obituary.submit');
Route::get('/list/obituary/posts', [ObituaryController::class, 'listObituaryPosts'])->name('obituary.listObituaryPosts');
Route::get('/obituary/{slug}', [ObituaryController::class, 'showObituaryDetails'])->name('obituary.details');

// remebrance controller
Route::get('/create/remembrance', [RemembranceController::class, 'createPost'])->name('remembrance.create');
Route::post('/submit/remembrance', [RemembranceController::class, 'submitPost'])->name('remembrance.submit');
Route::get('/posts/remembrance', [RemembranceController::class, 'listPosts'])->name('list-remembrance');
Route::get('/remembrance/{slug}', [RemembranceController::class, 'showRemembranceDetails'])->name('remembrance.details');


// change of name routes
Route::get('/create-change-of-name', [changeOfNameController::class, 'createPost'])->name('change-of-name.create');
Route::post('/submit-change-of-name', [changeOfNameController::class, 'submitPost'])->name('change-of-name.submit');
Route::get('/lists/change-of-name', [changeOfNameController::class, 'listPosts'])->name('list-change-of-name');
Route::get('/change-of-name/{slug}', [changeOfNameController::class, 'showChangeOfNameDetails'])->name('change-of-name.details');


// caveat routes
Route::get('/create/caveat', [CaveatController::class, 'createPost'])->name('caveat.create');
Route::post('/submit/caveat', [CaveatController::class, 'submitPost'])->name('caveat.submit');
Route::get('/caveat/{slug}', [CaveatController::class, 'showCaveatDetails'])->name('caveat.details');
Route::get('/posts/caveat', [CaveatController::class, 'listCaveatPosts'])->name('caveat.posts');

// cataegory and tag routes
Route::get('/create-category', [NewsPostController::class, 'createCategory'])->name('create-category');
Route::post('/submit-category', [NewsPostController::class, 'submitCategory'])->name('submit-category');
Route::get('/create-tag', [NewsPostController::class, 'createTag'])->name('create-tag');
Route::post('/submit-tag', [NewsPostController::class, 'submitTag'])->name('submit-tag');


// seeder category routes
Route::get('/create-category-seeder', [NewsPostController::class, 'createCategorySeeder'])->name('create-category-seeder');
Route::post('/submit-category-seeder', [NewsPostController::class, 'submitCategorySeeder'])->name('submit-category-seeder');

Route::get('/category/{slug}', [NewsPostController::class, 'show'])->name('category.show');


// celebration routes
Route::get('/create/birthday', [CelebrationController::class, 'createBirthday'])->name('create.birthday');
Route::get('/manage/birthday', [CelebrationController::class, 'manageBirthday'])->name('manage.birthday');
Route::post('submit/birthday', [celebrationController::class, 'submitBirthday'])->name('submit.birthday');
Route::get('/posts/birthday/lists', [CelebrationController::class, 'listBirthdayPosts'])->name('list.birthday-posts');
Route::get('/birthday/{slug}', [CelebrationController::class, 'showBirthdayDetails'])->name('birthday.details');

Route::get('/create/wedding', [CelebrationController::class, 'createWedding'])->name('create.wedding');
Route::get('/manage/wedding', [CelebrationController::class, 'manageWedding'])->name('manage.wedding');
Route::post('submit/wedding', [CelebrationController::class, 'submitWedding'])->name('submit.wedding');
Route::get('/lists/wedding/posts', [celebrationController::class, 'listWeddingPosts'])->name('lists.wedding');
Route::get('/wedding/{slug}', [CelebrationController::class, 'showWeddingDetails'])->name('wedding.details');

Route::get('/create/dedication', [CelebrationController::class, 'createDedication'])->name('create.dedication');
Route::get('/manage/dedication', [CelebrationController::class, 'manageDedication'])->name('manage.dedication');
Route::post('submit/dedication', [CelebrationController::class, 'submitDedication'])->name('submit.dedication');
Route::get('/lists/dedication', [celebrationController::class, 'listChildDedicationPosts'])->name('list.dedication');
Route::get('/posts/dedication/{slug}', [celebrationController::class, 'showDedicationDetails'])->name('dedication.details');


// stolen vehicles
Route::get('/create/stolen-vehicle', [StolenVehicle::class, 'create'])->name('create.vehicle');
Route::post('submit/stolen-vehicle', [StolenVehicle::class, 'submitPost'])->name('submit.vehicle');
Route::get('/lists/stolen-vehicle', [StolenVehicle::class, 'listStolenVehicles'])->name('list-stolen-vehicles');
Route::get('/stolen-vehicle/{slug}', [StolenVehicle::class, 'showStolenVehicleDetails'])->name('stolen-vehicles.details');


// newsletter routes
Route::post('/newsletter/subscribe', [UserController::class, 'newsletterSubscribe'])->name('newsltter.subscribe');

// upload photo news
Route::get('/upload/photo/news', [NewsPostController::class, 'uploadPhoto'])->name('upload-photo');
Route::post('/admin/upload-photo-news', [NewsPostController::class, 'uploadPhotoNews'])->name('admin.upload-photo-news');
Route::get('/manage/photos', [NewsPostController::class, 'showAllImages'])->name('manage-photos');
Route::get('/news/latest-image', [NewsPostController::class, 'showLatestImage'])->name('news.latest-image');


// currency exchange
Route::get('/exchange-rate', [ExchangeController::class, 'showCurrency'])->name('exchange-rate');


// Route::get('/payment/initiate', function () {
//     return view('payment.initiate');
// })->name('payment.initiate');

Route::get('/payment/initiate', function () {
    return view('payment.initiate');
})->name('payment.initiate');


// Route::get('/payment/initiate/{post_type}', function ($post_type) {
//     try {
//         $response = Http::get(config('api.base_url') . '/post-types/prices');
//         if ($response->successful()) {
//             $prices = $response->json()['data'];
//             $price = $prices[$post_type] ?? 500;
//         } else {
//             $price = 500;
//         }
//         return view('payment.initiate', compact('post_type', 'price'));
//     } catch (\Exception $e) {
//         return view('payment.initiate', ['post_type' => $post_type, 'price' => 500]);
//     }
// })->name('payment.initiate');

Route::post('/payment/start/{post_type}', [ExchangeController::class, 'startPayment'])->name('payment.start');

Route::get('/create/{post_type}', [ExchangeController::class, 'createPost'])->name('create.post');