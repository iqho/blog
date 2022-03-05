<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class MostPopular extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public function render()
    {
        $posts = Post::where('publish_status', 1)->where(function ($sub_query) {$sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('views', 'desc')->paginate(25);
        return view('livewire.frontend.most-popular', compact('posts'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
