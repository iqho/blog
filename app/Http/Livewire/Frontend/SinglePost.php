<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Admin\Comment;
use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\Session;

class SinglePost extends Component
{
    public $post;

    public function mount($slug)
    {
        $post_slug_exist = Post::where('slug', $slug)->first();
        if (!$post_slug_exist) {
            return abort(404);
        } else {
            $pid = $post_slug_exist->id;
            if (!(Session::get('id') == $pid)) {
                Post::where('id', $pid)->increment('views');
                Session::put('id', $pid);
            }
            return $this->post = Post::where('slug', $slug)->with('comments')->with('category')->first();
        }

    }

    public function render()
    {
        return view('livewire.frontend.single-post')->layout('layouts.app');
    }
}
