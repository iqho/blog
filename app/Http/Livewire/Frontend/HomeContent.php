<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;

class HomeContent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public function render()
    {
        $posts = Post::where(function ($sub_query) {$sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(10);
        $recentPost = Post::latest()->get()->take(10);
        $stickyPost = Post::orderBy('id','DESC')->where('is_sticky','1')->get()->take(5);
        return view('livewire.frontend.home-content', compact('posts', 'recentPost', 'stickyPost',))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    
    public function searchPost(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Post::where('title', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}