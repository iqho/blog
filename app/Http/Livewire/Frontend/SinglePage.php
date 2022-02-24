<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Admin\Page;
use Livewire\Component;

class SinglePage extends Component
{
    public $page;

    public function mount($slug)
    {
        return $this->page = Page::where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.frontend.single-page')->layout('layouts.app');
    }
}
