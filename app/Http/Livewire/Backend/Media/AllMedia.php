<?php

namespace App\Http\Livewire\Backend\Media;

use App\Models\Media;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class AllMedia extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;
    public $currentPage = 1;
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
        $data['media'] = Media::where('user_id', auth()->id())->where(function ($sub_query) {
            $sub_query->where('title', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('id', 'desc')->paginate(50);

        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkslug'] = Media::where('slug', '=', $this->slug)->exists();
        return view('livewire.backend.media.media', compact('data'));
        }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function generateTitle()
    {
        if ($this->media_name) {
        $title = pathinfo($this->media_name->getClientOriginalName(), PATHINFO_FILENAME);
        return $this->title = $title;
        }
        else{
            return $this->title = "No Title";
        }
    }

    public function generateSlug()
    {
        if(Str::length($this->title) == 0){
            $myslug = ''; 
        }
        else{
            $slug = Str::slug($this->title);
            $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        $autoslug = $this->slug = $myslug;
        $autocaption = $this->caption = $this->title;
        $autoalt = $this->alt = $this->title;
        $autodes = $this->description = $this->title;
        $this->checkMode = true ;
        return [$autoslug, $autocaption, $autoalt, $autodes];
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

    public function storeMedia()
        {
            $validatedDate = $this->validate([
                'title' => ['required', 'string', 'max:255'],
                'slug' => ['required', 'string', 'min:2', 'max:255', 'unique:media'],
                'media_name' => ['required', 'mimes:jpg,jpeg,png,svg,gif,mp4,mp3,avi', 'max:4096'],
                'caption' => ['required'],
                'media_type' => ['required'],
            ]);

        if (!empty($this->media_name)) {

            $slug = Str::slug($this->slug);
            $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

            $newImageName = $myslug . "." . $this->media_name->extension();
            $this->media_name->storeAs('media', $newImageName, 'public');

            Media::create([
                'title' => $this->title,
                'slug' => $myslug,
                'media_name' => $newImageName,
                'caption' => $this->caption,
                'alt' => $this->alt,
                'description' => $this->description,
                'media_type' => $this->media_type,
                'extension' => $this->media_name->extension(),
                'user_id' => auth()->id(),
            ], $validatedDate);
        }
            //User::create($validatedDate);
            session()->flash('message', 'Media Created Successfully.');
            $this->resetInputFields();
            $this->resetErrorBag();
            $this->resetValidation();
            $this->emit('mediaStore'); // Close model to using to jquery
        }

    public function details($id){
        $this->resetInputFields();
        $media = Media::where('id', $id)->first();
        $this->media_id = $id;
        $this->preBtn = $media->previous;
        $this->nextBtn = Media::findNext($id);
       // $this->nextBtn = Media::where('id', '>', $media->id)->min('id');
        //$this->nextBtn = '1';
        $this->title = $media->title;
        $this->slug = $media->slug;
        $this->media_name2 = $media->media_name;
        $this->caption = $media->caption;
        $this->alt = $media->alt;
        $this->description = $media->description;
        $this->media_type = $media->media_type;
        $this->mediaSize = Storage::size('public/media/' . $media->media_name);
        $this->mediaURL = url('storage/media/' . $media->media_name);
        $this->checkMode = false ; 
    }

    public function edit($id)
        {
        $this->resetInputFields();
        $media = Media::where('id', $id)->first();
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
        $this->updateMode = true;
        $this->checkMode = false ;
        }

    public function cancel()
        {
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        }

    public function updateMedia($id)
    {
        $validatedDate = $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255'],
            'media_name3' => 'nullable|mimes:jpg,jpeg,png,svg,gif,mp4,mp3,avi|max:4096',
            'caption' => ['required'],
            'media_type' => ['required'],
        ]);

            if($id){
                $media = Media::findOrFail($id);
                
                    if (!empty($this->media_name3)) {

                        if ($this->slug != $media->slug) {
                            $slug = Str::slug($this->slug);
                            $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
                            $newCount = $count > 0 ? ++$count : '';
                            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
                        } else {
                            $myslug = $this->slug;
                        }

                        File::delete([public_path('storage/media/' . $media->media_name)]); // Delete Old Image and Store New Image

                        $newImageName = $myslug . "." . $this->media_name3->extension();
                        $this->media_name3->storeAs('media', $newImageName, 'public');

                        $media->update([
                            'title' => $this->title,
                            'slug' => $myslug,
                            'media_name' => $newImageName,
                            'caption' => $this->caption,
                            'alt' => $this->alt,
                            'description' => $this->description,
                            'media_type' => $this->media_type,
                            'extension' => $this->media_name3->extension(),
                            'user_id' => auth()->id(),
                        ], $validatedDate);
                    }
                else{

                if ($this->slug != $media->slug) {
                    $slug = Str::slug($this->slug);
                    $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
                    $newCount = $count > 0 ? ++$count : '';
                    $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

                    if ($media->media_name != null && empty($this->media_name3)) {
                        $path_info = pathinfo(public_path('storage/media/' . $media->media_name));
                        $getExt = $path_info['extension'];
                        $newImgName = $myslug . "." . $getExt;
                        $currentPath = (public_path('storage/media/' . $media->media_name));
                        $newPath = (public_path('storage/media/' . $newImgName));
                        File::move($currentPath, $newPath); // If Change Slug than change also image name too
                    }

                    $media->update([
                        'title' => $this->title,
                        'slug' => $myslug,
                        'media_name' => $newImgName,
                        'caption' => $this->caption,
                        'alt' => $this->alt,
                        'description' => $this->description,
                        'media_type' => $this->media_type,
                        'user_id' => auth()->id(),
                    ], $validatedDate);

                } else {
                    $media->update([
                        'title' => $this->title,
                        'slug' => $this->slug,
                        'caption' => $this->caption,
                        'alt' => $this->alt,
                        'description' => $this->description,
                        'media_type' => $this->media_type,
                        'user_id' => auth()->id(),
                    ], $validatedDate);
                }

                }
            }
        //User::create($validatedDate);
        session()->flash('message', 'Media Updated Successfully.');
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('mediaUpdate'); // Close model to using to jquery
    }

    public function trashed($id)
        {
            if($id){
            Media::where('id', $id)->delete();
            session()->flash('message', 'Media Move to Trashed Successfully.');
            $this->emit('mediaUpdate');
            }
        }

    public function parmanentDelete($id)
    {
        $media = Media::withTrashed()->findOrFail($id);
        File::delete([public_path('storage/media/'. $media->media_name)]);
        $media->forceDelete();
        session()->flash('message', 'Media Deleted Successfully.');
    }
}
