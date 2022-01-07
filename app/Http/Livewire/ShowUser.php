<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ShowUser extends Component
{
    public function render()
    {
        return view('livewire.show-user', [
            'users' => User::all(),
        ]);
    }
}
