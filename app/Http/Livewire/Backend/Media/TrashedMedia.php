<?php

namespace App\Http\Livewire\Backend\Media;

use Illuminate\Support\Facades\File;
use Livewire\Component;
use App\Models\Media;

class TrashedMedia extends Component
{
    public function render()
    {
        $data['media'] = Media::onlyTrashed()->where('user_id', auth()->id())->latest()->get();
        return view('livewire.backend.media.trashed-media', compact('data'));
    }

    public function restore($id)
    {
        //dd($id);
        Media::onlyTrashed()->findOrFail($id)->restore();
        session()->flash('message', 'Media Restore Successfully.');
    }

    public function delete($id)
    {
        $media = Media::onlyTrashed()->findOrFail($id);
        File::delete([public_path('storage/media/'. $media->media_name)]);
        $media->forceDelete();
        session()->flash('message', 'Media Deleted Successfully.');
    }
}
