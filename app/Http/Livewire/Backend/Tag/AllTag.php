<?php

namespace App\Http\Livewire\Backend\Tag;

use Livewire\Component;
use App\Models\Admin\Tag;

class AllTag extends Component
{
    public function render()
    {
        return view('livewire.backend.tag.all-tag');
    }

    public function jsonTag(){
        $tagjson = Tag::orderBy('id', 'desc')->pluck('title')->all();
        return $tagjson ;
    }
}
