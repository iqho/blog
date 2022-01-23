<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;

class SinglePost extends Component
{

    public $post;
    
    public function mount(Post $slug)
    {
        return $this->post = $slug;
    }

    public function render()
    {
        return view('livewire.backend.post.single-post');
    }

}
