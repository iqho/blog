<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;


class AllPost extends Component
{

    use WithFileUploads;
    public $title, $slug, $description, $featured_image;

    public function moveToTrashed($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        //session()->flash('message', 'Post Move to Trashed Successfully.');
        return redirect(route('admin.all-post'))->with('message', 'Post Move to Trashed Successfully.');
    }

    public function parmanentDelete($id)
    {
        $post = Post::findOrFail($id);
        File::delete([public_path('storage/post-image/' . $post->featured_image)]);
        $post->forceDelete();
        return redirect(route('admin.all-post'))->with('message', 'Post Parmanently Deleted !');
    }

    public function render()
    {
        if (auth()->user()->user_type == 1) {
            $data['posts'] = Post::with('category')->with('users')->get();
        }
        else{
        $data['posts'] = Post::where('user_id', auth()->id())->with('category')->with('users')->get();
        }
        return view('livewire.backend.post.all-post', compact('data'));
    }

    public function MyPost()
    {
        $data['posts'] = Post::where('user_id', auth()->id())->with('category')->with('users')->get();
        return view('livewire.backend.post.my-post', compact('data'));
    }

}
