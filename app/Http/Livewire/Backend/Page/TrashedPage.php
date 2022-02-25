<?php

namespace App\Http\Livewire\Backend\Page;

use App\Models\Admin\Page;
use Livewire\Component;
use Illuminate\Support\Facades\File;

class TrashedPage extends Component
{
    public function render()
    {
        if (auth()->user()->user_type == 1) {
            $data['pages'] = Page::onlyTrashed()->with('users')->get();
        } else {
            $data['pages'] = Page::onlyTrashed()->where('user_id', auth()->id())->with('users')->get();
        }
        return view('livewire.backend.page.trashed-page', compact('data'));
    }

    public function parmanentDelete($id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        File::delete([public_path('storage/page-images/' . $page->featured_image)]);
        $page->forceDelete();
        return redirect(route('admin-panel.all-pages'))->with('message', 'Page Parmanently Deleted !');
    }

    public function restorePage($id)
    {
        Page::onlyTrashed()->find($id)->restore();
        return redirect(route('admin-panel.all-pages'))->with('message', 'Page Restore Successfully.');
    }
}
