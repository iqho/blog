<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Frontend\TagPost;
use App\Http\Livewire\Frontend\AuthorPost;

use App\Http\Livewire\Frontend\SinglePage;

use App\Http\Livewire\Frontend\SinglePost;
use App\Http\Livewire\Frontend\HomeContent;
use App\Http\Livewire\Frontend\CategoryPost;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Frontend\SearchPage;
use App\Models\Admin\Post;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;


use Illuminate\Http\Request;


// Front End Routes
Route::get('/', HomeContent::class)->name('home');
Route::get('/post/{slug}', SinglePost::class)->name('post.single-post');
Route::get('/post/author/{id}', AuthorPost::class)->name('post.author-post');
Route::get('/post/category/{slug}', CategoryPost::class)->name('post.category-post');
Route::get('/post/tag/{slug}', TagPost::class)->name('post.tag-post');

//Pages
Route::get('/page/{slug}', SinglePage::class)->name('page.single-page');

Route::get('/search', SearchPage::class)->name('post.search-post');
Route::get('/autocomplete-search', [SearchPage::class, 'autocompleteSearch'])->name('post.autocomplete-search');






//Route::view('profile2', 'profile.show2');

// Route Group for Editor
Route::group(['prefix' => 'editor', 'as' => 'editor.', 'middleware' => ['auth:sanctum', 'verified', 'is_editor']], function () {

});

// Route Group for Author
Route::group(['prefix' => 'author', 'as' => 'author.', 'middleware' => ['auth:sanctum', 'verified', 'is_author']], function () {

});

// Route Group for Contributor
Route::group(['prefix' => 'contributor', 'as' => 'contributor.', 'middleware' => ['auth:sanctum', 'verified', 'is_contributor']], function () {

});


// General Users / Subcribers
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});
