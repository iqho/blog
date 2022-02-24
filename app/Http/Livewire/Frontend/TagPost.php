<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use App\Models\Admin\PostTag;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class TagPost extends Component
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
        $tag = Tag::where('slug', $this->newslug)->first();
        if($tag){
            $tag_name = $tag->title;
        // $get_post_id = PostTag::where('tag_id', $tag->id)->get();
            $posts = Post::whereHas('tags', function($query) use ($tag_name) {$query->whereTitle($tag_name);})->where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
            })->orderBy('id', 'desc')->paginate(10);  
        }else{
            return abort(404);
        }

        return view('livewire.frontend.tag-post', compact( 'posts', 'tag_name'))->layout('layouts.app');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
