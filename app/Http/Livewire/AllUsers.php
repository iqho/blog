<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AllUsers extends Component
{
    public function render()
    {
        return view('livewire.all-users', [
            'users' => User::all()
        ]);
    }
}
