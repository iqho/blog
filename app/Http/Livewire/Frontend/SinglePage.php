<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Admin\Page;
use Livewire\Component;

class SinglePage extends Component
{
    public $page;

    public function mount($slug)
    {
        $page_slug_exist = Page::where('slug', $slug)->first();
        if (!$page_slug_exist) {
            return abort(404);
        }
        else{
        return $this->page = Page::where('slug', $slug)->first();
        }
    }

    public function render()
    {
        return view('livewire.frontend.single-page')->layout('layouts.app');
    }
}
