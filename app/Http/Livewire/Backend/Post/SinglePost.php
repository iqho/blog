<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;

class SinglePost extends Component
{

    public $post;
    
    public function mount($slug)
    {
        return $this->post = Post::withTrashed()->where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.backend.post.single-post');
    }

}
