<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Livewire\Component;

class AuthorPost extends Component
{
    public function mount($user_id)
    {
        $user = User::find($user_id);
        $allpost = $user->posts()->get();
        return $allpost;
    }
    public function render()
    {
        return view('livewire.frontend.author-post');
    }
}
