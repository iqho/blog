<?php

namespace App\Http\Livewire\Backend;

use App\Models\Media;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AllMedia extends Component
{
    use WithFileUploads;
    public $title, $slug, $media_name, $caption, $alt, $description, $media_type, $extension, $media_order, $user_id;
    public $updateMode = false;
    public $viewMode = false;
    public $mediaSize;
    public $mediaURL;

    public function render()
        {
        $data['media'] = Media::where('user_id', auth()->id())->latest()->get();
        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkslug'] = Media::where('slug', '=', $this->slug)->exists();
        return view('livewire.backend.media.media', compact('data'));
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
        $slug = Str::slug($this->title);
        $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        $autoslug = $this->slug = $myslug;
        $autocaption = $this->caption = $this->title;
        $autoalt = $this->alt = $this->title;
        $autodes = $this->description = $this->title;
        return [$autoslug, $autocaption, $autoalt, $autodes];
    }

    private function resetInputFields(){
        $this->title = '';
        $this->slug = '';
        $this->reset('media_name');
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
        $media = Media::where('id', $id)->first();
        $this->title = $media->title;
        $this->slug = $media->slug;
        $this->media_name = $media->media_name;
        $this->caption = $media->caption;
        $this->alt = $media->alt;
        $this->description = $media->description;
        $this->media_type = $media->media_type;
        $this->viewMode = true;
        //$size = Storage::size('public/'.$picture->filename);
        $this->mediaSize = Storage::size('public/media/'.$media->media_name);
        $this->mediaURL = url('storage/media/'.$media->media_name);
    }

    public function edit($id)
        {
            $media = Media::where('id', $id)->first();
            $this->title = $media->title;
            $this->slug = $media->slug;
            $this->caption = $media->caption;
            $this->alt = $media->alt;
            $this->description = $media->description;
            $this->updateMode = true;
        }
    public function cancel()
    {
       $this->resetInputFields();
    }

    public function updateUser()
        {
            $validatedDate = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                //'username' => ['required', 'min:3', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                //'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
                'phone_no' => ['nullable', 'string', 'max:255'],
                'social_media' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string', 'max:255'],
                ]);

            if ($this->user_id) {
            $user = Media::find($this->user_id);
            //$user->update($request->filled('password') ? $request->all() : $request->except(['password']));
                if(!empty($this->password)){

                $user->update([
                    'name' => $this->name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'phone_no' => $this->phone_no,
                    'bio' => $this->bio,
                    'social_media' => $this->social_media,
                    'user_type' => $this->user_type
                ], $validatedDate);
                }
                else{
                $user->update([
                    'name' => $this->name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'phone_no' => $this->phone_no,
                    'bio' => $this->bio,
                    'social_media' => $this->social_media,
                    'user_type' => $this->user_type
                ], $validatedDate);
                }

            $this->resetInputFields();
            session()->flash('message', 'User Upated Successfully.');
            $this->emit('userUpdate'); // Close model to using to jquery
             }
        }

    public function delete($id)
        {
            if($id){
            Media::where('id',$id)->delete();
            session()->flash('message', 'User Deleted Successfully.');
            }
        }

}
