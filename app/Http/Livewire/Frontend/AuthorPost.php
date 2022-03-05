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
       // $check_author = User::where('id', $id)->first();
        return $this->newid = $id;
    }

    public function render()
    {
    $author = User::where('id', $this->newid)->first();
    if($author){
    $author_name = $author->name;
    $posts = Post::where('publish_status', 1)->where('user_id', $this->newid)->where(function ($sub_query) {
                 $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);
    }
    else{
            return abort(404);
    }
        return view('livewire.frontend.author-post', compact('posts', 'author_name'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
