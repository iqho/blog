<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;

class CategoryPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $newslug;

    public function mount($slug)
    {
        return $this->newslug = $slug;
    }

    public function render()
    {
        $category = Category::where('slug', $this->newslug)->first();
        $cat_name = $category->name;
        $posts = Post::where('category_id', $category->id)->where(function ($sub_query) {
            $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(10);
        return view('livewire.frontend.category-post', compact('posts', 'cat_name'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

}
