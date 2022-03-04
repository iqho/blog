<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Frontend\TagPost;
use App\Http\Livewire\Frontend\AuthorPost;

use App\Http\Livewire\Frontend\SinglePost;
use App\Http\Livewire\Frontend\HomeContent;
use App\Http\Livewire\Frontend\CategoryPost;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Frontend\MostPopular;
use App\Http\Livewire\Frontend\MostRecent;
use App\Http\Livewire\Frontend\SearchPage;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;


// Front End Routes
Route::get('/', HomeContent::class)->name('home');
Route::get('/{category}/{slug}', SinglePost::class)->name('post.single-post');
Route::get('/post/author/{id}', AuthorPost::class)->name('post.author-post');
Route::get('/{slug}', CategoryPost::class)->name('post-category'); // Single Page Details Include with this route

Route::get('/post/tag/{slug}', TagPost::class)->name('post.tag-post');

Route::get('/post/nav/search', SearchPage::class)->name('post.search-post');
Route::get('/post/nav/autocomplete-search', [SearchPage::class, 'autocompleteSearch'])->name('post.autocomplete-search');

Route::post('/post/comment/store', [SinglePost::class, 'storeReply'])->name('comments.store');
Route::get('/post/most-recent/all', MostRecent::class)->name('post.all-most-recent-post');
Route::get('/post/most-popular/all', MostPopular::class)->name('post.all-most-popular-post');




//Route::view('profile2', 'profile.show2');

// Route Group for Editor
Route::group(['prefix' => 'backend/editor', 'as' => 'editor.', 'middleware' => ['auth:sanctum', 'verified', 'is_editor']], function () {

});

// Route Group for Author
Route::group(['prefix' => 'backend/author', 'as' => 'author.', 'middleware' => ['auth:sanctum', 'verified', 'is_author']], function () {

});

// Route Group for Contributor
Route::group(['prefix' => 'backend/contributor', 'as' => 'contributor.', 'middleware' => ['auth:sanctum', 'verified', 'is_contributor']], function () {

});


// General Users / Subcribers
Route::group(['prefix' => 'backend/user', 'as' => 'user.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});
