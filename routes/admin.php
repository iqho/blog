<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\AllUsers;
use App\Http\Livewire\Backend\Post\AllPost;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Backend\Post\SinglePost;
use App\Http\Livewire\Backend\Post\TrashedPost;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Livewire\Backend\Category\AllCategory;
use App\Http\Livewire\Backend\Category\TrashedCategory;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
Route::get('/all-users', AllUsers::class)->name('all-users');
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

// Post
Route::get('/all-post', AllPost::class)->name('all-post');
Route::get('/posts/{slug}', SinglePost::class)->name('single-post');

Route::get('/post/create', [AllPost::class, 'create'])->name('post-create');
Route::post('/post/store', [AllPost::class, 'store'])->name('post-store');

Route::get('/post/trashed-post', TrashedPost::class)->name('trashedPost');


// Category
Route::get('/category', AllCategory::class)->name('category');
Route::get('/category/trashed-category', TrashedCategory::class)->name('trashedCategory');

Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
