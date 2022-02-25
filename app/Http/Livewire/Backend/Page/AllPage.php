<?php

namespace App\Http\Livewire\Backend\Page;

use App\Models\Admin\Page;
use Livewire\Component;
use Illuminate\Support\Facades\File;

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

    public function parmanentDelete($id)
    {
        $page = Page::findOrFail($id);
        File::delete([public_path('storage/page-images/' . $page->featured_image)]);
        $page->forceDelete();
        return redirect(route('admin-panel.all-pages'))->with('message', 'Page Parmanently Deleted !');
    }
    public function moveToTrashed($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        //session()->flash('message', 'Post Move to Trashed Successfully.');
        return redirect(route('admin-panel.all-pages'))->with('message', 'Page Move to Trashed Successfully.');
    }

}
