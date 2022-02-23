<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Post;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class AuthorPost extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;

    public $newid;

    public function mount($id)
    {
        return $this->newid = $id;
    }

    public function render()
    {
    $author = User::where('id', $this->newid)->first();
    $author_name = $author->name;
    $posts = Post::where('user_id', $this->newid)->where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);
        return view('livewire.frontend.author-post',compact('posts', 'author_name'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
