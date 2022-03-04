<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Frontend\TagPost;
use App\Http\Livewire\Frontend\AuthorPost;

use App\Http\Livewire\Frontend\MostRecent;
use App\Http\Livewire\Frontend\SearchPage;
use App\Http\Livewire\Frontend\SinglePost;
use App\Http\Livewire\Backend\Post\AllPost;
use App\Http\Livewire\Frontend\HomeContent;
use App\Http\Livewire\Frontend\MostPopular;
use App\Http\Livewire\Backend\Post\EditPost;
use App\Http\Livewire\Frontend\CategoryPost;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Backend\Media\AllMedia;
use App\Http\Livewire\Backend\Post\CreatePost;
use App\Http\Livewire\Backend\Post\TrashedPost;
use App\Http\Livewire\Backend\Media\AllMediaList;
use App\Http\Livewire\Backend\Media\TrashedMedia;
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
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

    // Post
    Route::get('/all-posts', AllPost::class)->name('all-posts');

    Route::get('/post/edit/{id}', EditPost::class)->name('edit-post');
    Route::post('/post/edit/store', [EditPost::class, 'updatePost'])->name('update-post');
    Route::get('/post/trashed-post', TrashedPost::class)->name('trashedPost');

    Route::get('/post/create', CreatePost::class)->name('post-create');
    Route::post('/post/store', [CreatePost::class, 'storePost'])->name('post-store');
    Route::post('/post/image-upload', [CreatePost::class, 'imageUpload'])->name('ck.upload');

    //Media Gallery
    Route::get('/media', AllMedia::class)->name('media');
    Route::get('/media/list-view', AllMediaList::class)->name('media.list-view');
    Route::get('/media/trashed-media', TrashedMedia::class)->name('media.trashed');
    
});

// Route Group for Contributor
Route::group(['prefix' => 'backend/contributor', 'as' => 'contributor.', 'middleware' => ['auth:sanctum', 'verified', 'is_contributor']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

    // Post
    Route::get('/all-posts', AllPost::class)->name('all-posts');

    Route::get('/post/edit/{id}', EditPost::class)->name('edit-post');
    Route::post('/post/edit/store', [EditPost::class, 'updatePost'])->name('update-post');

    Route::get('/post/create', CreatePost::class)->name('post-create');
    Route::post('/post/store', [CreatePost::class, 'storePost'])->name('post-store');

    Route::post('/post/image-upload', [CreatePost::class, 'imageUpload'])->name('ck.upload');
});


// General Users / Subcribers
Route::group(['prefix' => 'backend/user', 'as' => 'user.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard'); // admin.dashboard
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
});
