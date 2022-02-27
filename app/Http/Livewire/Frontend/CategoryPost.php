<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use App\Models\Admin\Category;
use App\Models\Admin\Page;
use Illuminate\Pagination\Paginator;

class CategoryPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $slug;
    public $pageMode = false;

    public function mount($slug)
    {
        return $this->slug = $slug;
    }

    public function render()
    {
        $check_category = Category::where('slug', $this->slug)->first();
        $check_page = Page::where('slug', $this->slug)->first();
        if($check_category){
            $this->pageMode = false;
            $cat_name = $check_category->name;
            $posts = Post::where('category_id', $check_category->id)->where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);
        return view('livewire.frontend.category-post', compact('posts', 'cat_name'))->layout('layouts.app');
        }
        elseif($check_page){
        $this->pageMode = true;
        $pages = Page::where('slug', $this->slug)->first();
        return view('livewire.frontend.category-post', compact('pages'))->layout('layouts.app');
       }
        else{
        return abort(404);
        }

    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
