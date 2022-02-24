<?php

namespace App\Http\Livewire\Frontend\Common;

use Livewire\Component;
use App\Models\Admin\Category;

class SideWidgets extends Component
{
    public function render()
    {
       // $categories = Category::orderBy('id', 'desc')->get();
       $categories = Category::where('parent_id', null)->orderBy('id', 'desc')->get();
        return view('livewire.frontend.common.side-widgets', compact('categories'));
    }
}
