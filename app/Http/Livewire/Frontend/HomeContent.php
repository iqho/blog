<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class HomeContent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public function render()
    {
        $posts = Post::where('publish_status', 1)->where(function ($sub_query) {$sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(25);
        $recentPost = Post::where('publish_status', 1)->latest()->get()->take(10);
        $stickyPost = Post::where('publish_status', 1)->orderBy('id','DESC')->where('is_sticky','1')->get()->take(5);
        return view('livewire.frontend.home-content', compact('posts', 'recentPost', 'stickyPost',))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
