<?php

namespace App\Http\Livewire\Backend\Page;

use App\Models\Admin\Page;
use Livewire\Component;

class AllPage extends Component
{
    public function render()
    {
        if (auth()->user()->user_type == 1) {
            $data['pages'] = Page::with('users')->get();
        }
        else{
        $data['pages'] = Page::where('user_id', auth()->id())->with('users')->get();
        }
        return view('livewire.backend.page.all-page', compact('data'));
    }
}
