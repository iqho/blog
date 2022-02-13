<?php

namespace App\Http\Livewire\Backend\Tag;

use Livewire\Component;
use App\Models\Admin\Tag;
use Illuminate\Support\Str;

class AllTag extends Component
{
    public $title, $slug, $meta_description, $tag_id;
    public $updateMode = false;
    public $checkingMode = false;

    public function render()
    {
        $data['tags'] = Tag::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkslug'] = Tag::where('slug', '=', Str::slug($this->slug))->exists();

        return view('livewire.backend.tag.all-tags', compact('data'));
    }

    public function jsonTag(){
        $tagjson = Tag::orderBy('id', 'desc')->pluck('title')->all();
        return $tagjson ;
    }

    public function resetInputFields()
    {
        $this->title = '';
        $this->slug = '';
        $this->meta_description = '';
        $this->resetErrorBag();
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->checkingMode = false;
    }

    public function generateSlug()
    {
        $this->checkingMode = true;
        if(Str::length($this->title) == 0){
            $myslug = '';
        }
        else{
            $slug = Str::slug($this->title);
            $count = Tag::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        $autoslug = $this->slug = $myslug;
        $autodes = $this->meta_description = $this->title;
        $this->checkMode = true ;
        return [$autoslug, $autodes];
    }

    public function checkSlug()
    {
            $this->checkingMode = true;
            $data['checkEmpty'] = Str::length($this->slug);
            $data['checkslug'] = Tag::where('slug', '=', Str::slug($this->slug))->exists();
    }

    public function storeTag(){

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255', 'unique:tags'],
        ]);

        $slug = Str::slug($this->slug);
        $count = Tag::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        $tag = new Tag;
        $tag->title = $this->title;
        $tag->slug = $myslug;
        $tag->meta_description = $this->meta_description;
        $tag->user_id = auth()->id();
        $tag->save();

        // Tag::create([
        //     'name' => $this->title,
        //     'slug' => $myslug,
        //     'meta_description' => $this->meta_description,
        //     'user_id' => auth()->id(),
        // ], $validatedDate);

        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('tagStore');
        session()->flash('message', 'Tag Created Successfully.');
    }

    public function edit($id){
        $this->updateMode = true;
        $tag = Tag::findOrFail($id);
        $this->tag_id = $id;
        $this->title = $tag->title;
        $this->slug = $tag->slug;
        $this->meta_description = $tag->meta_description;
    }

    public function updateTag($id){

        $tag = Tag::findOrFail($id);

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'min:2', 'max:255', 'unique:tags,slug,' . $tag->id],
        ]);

        $slug = Str::slug($this->slug);
        $count = Tag::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

        $tag->title = $this->title;
        $tag->slug = $myslug;
        $tag->meta_description = $this->meta_description;
        $tag->user_id = auth()->id();
        $tag->update();

        $this->resetInputFields();
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('tagStore');
        session()->flash('message', 'Tag Updated Successfully.');
    }

    public function trashed($id)
    {
        if($id){
        Tag::where('id', $id)->delete();
        return redirect(route('admin-panel.all-tags'))->with('message', 'This Tag Move to Trashed Successfully.');
        }
    }

}
