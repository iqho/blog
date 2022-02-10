<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\AllUsers;
use App\Http\Controllers\DashboardController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
Route::get('/all-users', AllUsers::class)->name('all-users');
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');




