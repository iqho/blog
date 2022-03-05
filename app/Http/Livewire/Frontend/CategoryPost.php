<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use App\Models\Admin\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

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
            $posts = Post::where('publish_status', 1)->where('category_id', $check_category->id)->where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);
        return view('livewire.frontend.category-post', compact('posts', 'cat_name'))->layout('layouts.app');
        }
        elseif($check_page){
        $this->pageMode = true;

        if (!(Session::get('id') == $check_page->id)) {
            Page::where('id', $check_page->id)->increment('views');
            Session::put('id', $check_page->id);
        }

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
