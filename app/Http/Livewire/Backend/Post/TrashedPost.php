<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class TrashedPost extends Component
{
    public function restorePost($id)
    {
        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            Post::onlyTrashed()->findOrFail($id)->restore();
        } elseif (auth()->user()->user_type == 0) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } elseif (auth()->user()->user_type == 4) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } else {
            Post::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id)->restore();
        }

        if (Gate::allows('isAdmin')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        } elseif (Gate::allows('isEditor')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        } else {
            return redirect(route('author.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        }
    }

    public function parmanentDelete($id)
    {

        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            $post = Post::onlyTrashed()->findOrFail($id);
            File::delete([public_path('storage/post-images/' . $post->featured_image)]);
            $post->forceDelete();
        } 
        elseif (auth()->user()->user_type == 0) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } 
        elseif (auth()->user()->user_type == 4) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } 
        else {
            $post = Post::onlyTrashed()->where('user_id', auth()->id())->findOrFail($id);
            File::delete([public_path('storage/post-images/' . $post->featured_image)]);
            $post->forceDelete();
        }

        if (Gate::allows('isAdmin')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Parmanently Deleted');
        } elseif (Gate::allows('isEditor')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Parmanently Deleted');
        } else {
            return redirect(route('author.all-posts'))->with('message', 'Post Parmanently Deleted');
        }
        
    }

    public function render()
    {
        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            $data['posts'] = Post::onlyTrashed()->with('category')->with('user')->get();
        }
        else{
        $data['posts'] = Post::onlyTrashed()->where('user_id', auth()->id())->with('category')->with('user')->get();
        }

        return view('livewire.backend.post.trashed-post', compact('data'));
    }
}
