<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\AllUsers;
use App\Http\Livewire\Backend\Post\AllPost;

Route::get('/all-users', AllUsers::class)->name('all-users');




