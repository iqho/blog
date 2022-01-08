<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowPost extends Component
{
    public function render()
    {
        return view('livewire.show-posts', [
            'users' => User::all(),
        ]);
    }
}
