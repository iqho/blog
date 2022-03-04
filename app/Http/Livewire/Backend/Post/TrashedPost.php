<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\File;

class TrashedPost extends Component
{
    public function restorePost($id)
    {
        Post::onlyTrashed()->find($id)->restore();
        //session()->flash('message', 'Post Restore Successfully.');
        return redirect(route('admin-panel.all-post'))->with('message', 'Post Restore Successfully.');
    }

    public function parmanentDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        File::delete([public_path('storage/post-image/' . $post->featured_image)]);
        $post->forceDelete();
        //session()->flash('message', 'Post Deleted Successfully.');
        return redirect(route('admin-panel.trashedPost'))->with('message', 'Post Parmanently Deleted !');
    }

    public function render()
    {
        if (auth()->user()->user_type == 1) {
            $data['posts'] = Post::onlyTrashed()->with('category')->with('user')->get();
        }
        else{
        $data['posts'] = Post::onlyTrashed()->where('user_id', auth()->id())->with('category')->with('user')->get();
        }

        //$data['posts'] = Post::onlyTrashed()->with('category')->get();
        return view('livewire.backend.post.trashed-post', compact('data'));
    }
}
