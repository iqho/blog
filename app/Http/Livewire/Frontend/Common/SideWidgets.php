<?php

namespace App\Http\Livewire\Frontend\Common;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\Post;
use App\Models\SideWidget;
use App\Models\Admin\Category;

class SideWidgets extends Component
{
    public function render()
    {

       $rightWidgets = SideWidget::orderBy('reorder', 'asc')->where('position','right')->get();

       $recentPost = Post::orderBy('id', 'desc')->get()->take(20);
       $mostView = Post::orderBy('views', 'desc')->get()->take(20);
       $categories = Category::where('parent_id', null)->with('posts')->orderBy('id', 'desc')->get();

    //    $popular_author = User::with('posts')->withCount('posts')->has('posts', '>=', 5)->orderByDesc('posts_count')
    //    ->get();
       $popular_author = User::with('posts')->withCount('posts')->orderByDesc('posts_count')->get()->take(20);
        return view('livewire.frontend.common.side-widgets', compact('categories', 'recentPost', 'mostView', 'rightWidgets', 'popular_author'));
    }
}
