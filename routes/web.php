<?php

use App\Http\Livewire\Backend\AllMedia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

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

//Route::view('profile2', 'profile.show2');

// Route Group for Editor
Route::group(['prefix' => 'editor', 'as' => 'editor.', 'middleware' => ['auth:sanctum', 'verified', 'is_editor']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});

// Route Group for Author
Route::group(['prefix' => 'author', 'as' => 'author.', 'middleware' => ['auth:sanctum', 'verified', 'is_author']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});

// Route Group for Contributor
Route::group(['prefix' => 'contributor', 'as' => 'contributor.', 'middleware' => ['auth:sanctum', 'verified', 'is_contributor']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});


// General Users / Subcribers
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});

// Auth Commm Route
Route::group(['prefix' => 'admin-panel', 'as' => 'admin-panel.', 'middleware' => ['auth:sanctum', 'verified']], function () {

//Media Gallery
Route::get('/media', AllMedia::class)->name('media');
Route::get('/media/create', [AllMedia::class, 'create'])->name('create.media');
Route::get('/media/edit/{id}', [AllMedia::class, 'edit'])->name('edit.media');
Route::get('/media/update', [AllMedia::class, 'update'])->name('update.media');
Route::get('/media/delete/{id}', [AllMedia::class, 'destroy'])->name('destroy.media');

});
