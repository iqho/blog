<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;


class AllPost extends Component
{

    use WithFileUploads;
    public $title, $slug, $description, $featured_image;

    public function moveToTrashed($id)
    {
        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            $post = Post::findOrFail($id);
            $post->delete();
        } 
        elseif(auth()->user()->user_type == 0) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        }
        elseif(auth()->user()->user_type == 4) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        }
        else {
            $post = Post::where('user_id', auth()->id())->findOrFail($id);
            $post->delete();
        }

        if (Gate::allows('isAdmin')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        } 
        elseif (Gate::allows('isEditor')) {
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        }
        else {
            return redirect(route('author.all-posts'))->with('message', 'Post Move to Trashed Successfully');
        }
    }

    public function parmanentDelete($id)
    {
        if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2) {
            $post = Post::findOrFail($id);
            File::delete([public_path('storage/post-images/' . $post->featured_image)]);
            $post->forceDelete();
        } elseif (auth()->user()->user_type == 0) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } elseif (auth()->user()->user_type == 4) {
            return redirect(route('contributor.all-posts'))->with('message', 'You have no permission to Delete Post');
        } else {
            $post = Post::where('user_id', auth()->id())->findOrFail($id);
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
            $data['posts'] = Post::with('category')->with('user')->orderBy('id', 'desc')->get();
        }
        else{
        $data['posts'] = Post::where('user_id', auth()->id())->with('category')->with('user')->get();
        }
        return view('livewire.backend.post.all-post', compact('data'));
    }

    public function MyPost()
    {
        $data['posts'] = Post::where('user_id', auth()->id())->with('category')->with('user')->get();
        return view('livewire.backend.post.my-post', compact('data'));
    }

    public function updateStatus($id)
    {
        $posts = Post::findOrFail($id);
        if($posts->publish_status == 0){
            $posts->publish_status = 1;
        } 
        else {
            $posts->publish_status = 0;
        }
        $posts->save();
        session()->flash('message', 'Post Publish Status Successfully Updated !');
    }

}
