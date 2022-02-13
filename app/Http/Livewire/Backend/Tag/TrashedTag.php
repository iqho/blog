<?php

namespace App\Http\Livewire\Backend\Tag;

use Livewire\Component;
use App\Models\Admin\Tag;

class TrashedTag extends Component
{

    public function render()
    {
        $data['tags'] = Tag::onlyTrashed()->where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('livewire.backend.tag.trashed-tag', compact('data'));
    }

    public function restore($id)
    {
        Tag::onlyTrashed()->findOrFail($id)->restore();
        return redirect(route('admin-panel.all-tags'))->with('message', 'Tag Restore Successfully.');
    }

    public function delete($id)
    {
        $tag = Tag::onlyTrashed()->findOrFail($id);
        $tag->forceDelete();
        return redirect(route('admin-panel.tag.trashed-tag'))->with('message', 'Tag Deleted Successfully.');
    }
}
