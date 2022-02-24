<?php

namespace App\Http\Livewire\Backend\Page;

use Livewire\Component;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class CreatePage extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $description;
    public $featured_image;

    public function render()
    {
        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkSlug'] = Page::where('slug', '=', Str::slug($this->slug))->exists();
        return view('livewire.backend.page.create-page', compact('data'));
    }

    public function generateSlug()
    {
        if(Str::length($this->title) == 0){
            $myslug = '';
        }
        else{
            $slug = Str::slug($this->title);
            $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        return $this->slug = $myslug;
    }

    public function storePage(Request $request)
        {
            date_default_timezone_set("Asia/Dhaka");

           $request->validate([
                 'title' => ['required', 'string', 'max:255'],
                 'slug' => ['required', 'string', 'min:2', 'max:255', 'Unique:posts'],
                 'description' => 'required',
                 'meta_description' => ['required', 'string', 'min:2', 'max:500'],
                 'publish_status' => ['required','boolean'],
                 'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                 'tags' => 'required',
            ]);

            $slug = Str::slug($request->slug);
            $count = Page::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

            if (!empty($request->featured_image)) {
                $newImageName = $myslug.".".$request->featured_image->extension();
                $request->featured_image->storeAs('page-images', $newImageName, 'public');
                //$imageurl = url('storage') . '/' . $image;
            } else {
                $newImageName = "default-feature-image.png";
            }

            $post = new Page;
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->description = $request->description;
            $post->meta_description = $request->meta_description;
            $post->publish_status = $request->publish_status;
            $post->is_sticky = $request->is_sticky ? $request->is_sticky : 0;
            $post->featured_image = $newImageName;
            $post->tags = $request->tags;
            $post->user_id = auth()->id();
            $post->save();

            return redirect(route('admin-panel.all-pages'))->with('message', 'Page Created Successfully');

        }

}
