<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Backend\Tag\AllTag;
use App\Http\Livewire\Backend\Page\AllPage;
use App\Http\Livewire\Backend\Post\AllPost;
use App\Http\Livewire\Backend\Page\EditPage;
use App\Http\Livewire\Backend\Post\EditPost;

use App\Http\Livewire\Backend\Widget\Widget;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Backend\Media\AllMedia;

use App\Http\Livewire\Backend\Tag\TrashedTag;
use App\Http\Livewire\Backend\Page\CreatePage;
use App\Http\Livewire\Backend\Post\CreatePost;
use App\Http\Livewire\Backend\Page\TrashedPage;

use App\Http\Livewire\Backend\Post\TrashedPost;

use App\Http\Livewire\Backend\Media\AllMediaList;

use App\Http\Livewire\Backend\Media\TrashedMedia;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Livewire\Backend\Category\AllCategory;
use App\Http\Livewire\Backend\Category\TrashedCategory;
use App\Http\Livewire\Backend\Comment\AllComment;
use App\Http\Livewire\Backend\Comment\TrashedComment;
use App\Http\Livewire\Backend\Widget\TrashedWidget;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

//Media Gallery
Route::get('/media', AllMedia::class)->name('media');
Route::get('/media/list-view', AllMediaList::class)->name('media.list-view');
Route::get('/media/trashed-media', TrashedMedia::class)->name('media.trashed');

// Post
Route::get('/all-posts', AllPost::class)->name('all-posts');

Route::get('/post/edit/{id}', EditPost::class)->name('edit-post');
Route::post('/post/edit/store', [EditPost::class, 'updatePost'])->name('update-post');
Route::get('/post/trashed-post', TrashedPost::class)->name('trashedPost');

Route::get('/post/create', CreatePost::class)->name('post-create');
Route::post('/post/store', [CreatePost::class, 'storePost'])->name('post-store');
Route::post('/post/image-upload', [CreatePost::class, 'imageUpload'])->name('ck.upload');

// Tag
Route::get('/tag/json', [AllTag::class, 'jsonTag'])->name('tag-json'); // Get Taglist in CreatePost Page
Route::get('/all-tags', AllTag::class)->name('all-tags');
Route::get('/tag/trashed-tag', TrashedTag::class)->name('tag.trashed-tag');

// Category
Route::get('/category', AllCategory::class)->name('category');
Route::get('/category/trashed-category', TrashedCategory::class)->name('trashedCategory');
Route::any('/category/create', [CategoryController::class, 'createCategory'])->name('createCategory');

// Users
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');

// Page
Route::get('/all-pages', AllPage::class)->name('all-pages');
Route::get('/page/create', CreatePage::class)->name('page-create');
Route::post('/page/store', [CreatePage::class, 'storePage'])->name('page-store');
Route::get('/page/edit/{id}', EditPage::class)->name('edit-page');
Route::post('/page/edit/store', [EditPage::class, 'updatePage'])->name('update-page');
Route::get('/page/trashed-pages', TrashedPage::class)->name('trashed-pages');

// Side Widget
Route::get('/widget/all-widgets', Widget::class)->name('all-widgets');
Route::get('/widget/all-trashed-widgets', TrashedWidget::class)->name('all-trashed-widgets');

// Comments
Route::get('/comments/all-comments', AllComment::class)->name('all-comments');
Route::get('/comments/all-inactive-comments', [AllComment::class, 'inactiveComments'])->name('all-inactive-comments');
Route::get('/comments/all-trashed-comments', TrashedComment::class)->name('all-trashed-comments');

