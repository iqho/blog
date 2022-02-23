<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\AllUsers;

Route::get('/all-users', AllUsers::class)->name('all-users');



