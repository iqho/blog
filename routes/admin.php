<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\AllUsers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Livewire\Backend\Category\AllCategory;
use App\Http\Livewire\Backend\Category\TrashedCategory;


Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
Route::get('/all-users', AllUsers::class)->name('all-users');
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

// Category
Route::get('/category', AllCategory::class)->name('category');
Route::get('/category/trashed-category', TrashedCategory::class)->name('trashedCategory');

Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');
