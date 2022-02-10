<?php

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
