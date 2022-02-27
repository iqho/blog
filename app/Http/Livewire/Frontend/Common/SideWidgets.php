<?php

namespace App\Http\Livewire\Frontend\Common;

use Livewire\Component;
use App\Models\Admin\Category;
use App\Models\Admin\Post;

class SideWidgets extends Component
{
    public function render()
    {
       $recentPost = Post::orderBy('id', 'desc')->get()->take(20);
       $mostView = Post::orderBy('views', 'desc')->get()->take(20);
       $categories = Category::where('parent_id', null)->with('posts')->orderBy('id', 'desc')->get();
        return view('livewire.frontend.common.side-widgets', compact('categories', 'recentPost', 'mostView'));
    }
}
