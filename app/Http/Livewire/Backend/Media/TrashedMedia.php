<?php

namespace App\Http\Livewire\Backend\Media;

use App\Models\Media;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrashedMedia extends Component
{
    public $title, $slug, $media_name, $media_name2, $media_name3, $caption, $alt, $description, $media_type, $extension, $media_order, $user_id, $media_id,
    $newImageName;
    public $updateMode = false;
    public $viewMode = false;
    public $mediaSize;
    public $mediaURL;
    public $checkMode = false;
    public $nextBtn;
    public $preBtn;

    public function render()
    {
        $data['media'] = Media::onlyTrashed()->where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('livewire.backend.media.trashed-media', compact('data'));
    }

    private function resetInputFields(){
        $this->title = '';
        $this->slug = '';
        $this->reset('media_name');
        $this->reset('media_name3');
        $this->reset('media_type');
        $this->caption = '';
        $this->alt = '';
        $this->description = '';
        $this->media_order = '';
        $this->user_id = '';
        $this->viewMode = false;
        $this->updateMode = false;
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function details($id){
        $media = Media::onlyTrashed()->where('id', $id)->orderBy('id', 'desc')->first();
        $this->preBtn = Media::onlyTrashed()->where('id', '>', $media->id)->orderBy('id', 'asc')->first();
        $this->nextBtn = Media::onlyTrashed()->where('id', '<', $media->id)->orderBy('id', 'desc')->first();
        $this->media_id = $id;
        $this->title = $media->title;
        $this->slug = $media->slug;
        $this->media_name2 = $media->media_name;
        $this->caption = $media->caption;
        $this->alt = $media->alt;
        $this->description = $media->description;
        $this->media_type = $media->media_type;
        $this->mediaSize = Storage::size('public/media/' . $media->media_name);
        $this->mediaURL = url('storage/media/' . $media->media_name);
        //$this->resetInputFields();
    }

    public function restore($id)
    {
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
