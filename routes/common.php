<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\Post\AllPost;
use App\Http\Livewire\Backend\Post\EditPost;
use App\Http\Livewire\Backend\Post\CreatePost;
use App\Http\Livewire\Backend\Post\SinglePost;
use App\Http\Livewire\Backend\Post\TrashedPost;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Livewire\Backend\Category\AllCategory;
use App\Http\Livewire\Backend\Category\TrashedCategory;

use App\Http\Livewire\Backend\Media\AllMedia;
use App\Http\Livewire\Backend\Media\AllMediaList;
use App\Http\Livewire\Backend\Media\TrashedMedia;



//Media Gallery
Route::get('/media', AllMedia::class)->name('media');
Route::get('/media/list-view', AllMediaList::class)->name('media.list-view');
Route::get('/media/trashed-media', TrashedMedia::class)->name('media.trashed');

// Post
Route::get('/all-posts', AllPost::class)->name('all-posts');
Route::get('/post/details/{slug}', SinglePost::class)->name('single-post');

Route::get('/post/edit/{id}', EditPost::class)->name('edit-post');
Route::get('/post/edit/store', [EditPost::class, 'updatePost'])->name('update-post');

Route::get('/post/create', CreatePost::class)->name('post-create');
Route::post('/post/store', [CreatePost::class, 'storePost'])->name('post-store');
Route::post('/post/image-upload', [CreatePost::class, 'imageUpload'])->name('ck.upload');

Route::get('/tag/json', [CreatePost::class, 'jsonTag'])->name('tag-json'); // Get Taglist in CreatePost Page
Route::post('/tag/store', [CreatePost::class, 'storeTag'])->name('tag-store');

Route::get('/post/trashed-post', TrashedPost::class)->name('trashedPost');

// Category
Route::get('/category', AllCategory::class)->name('category');
Route::get('/category/trashed-category', TrashedCategory::class)->name('trashedCategory');
Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');


