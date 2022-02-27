<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class SearchPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $currentPage = 1;
    public $searchTerm;

    public function mount(Request $request)
    {
        $this->searchTerm = $request->get('q');
    }

    public function render()
    {
        $keyword = $this->searchTerm;
        $posts = Post::where(function ($sub_query) {
            $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(20);
        return view('livewire.frontend.search-page', compact('posts', 'keyword'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function autocompleteSearch(Request $request)
    {
        $this->searchTerm = $request->get('term');
        $result = Post::where(function ($sub_query) {
            $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->get()->take(10);
        return response()->json($result);
    }

}
