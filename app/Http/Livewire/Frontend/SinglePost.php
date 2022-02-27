<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Post;

class SinglePost extends Component
{
    public $post;

    public function mount($slug)
    {
        $post_slug_exist = Post::where('slug', $slug)->first();
        if (!$post_slug_exist) {
            return abort(404);
        } else {
            return $this->post = Post::where('slug', $slug)->with('category')->first();
        }

    }

    public function render()
    {
        return view('livewire.frontend.single-post')->layout('layouts.app');
    }
}
