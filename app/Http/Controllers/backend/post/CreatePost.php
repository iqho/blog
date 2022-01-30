<?php

namespace App\Http\Controllers\backend\post;

use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Unique;

class CreatePost extends Controller
{
    public function create()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();
        $data['tagOption'] = Tag::orderBy('id', 'desc')->get();
        return view('backend.post.create-post', compact('data'));
    }


    public function storePost(Request $request)
        {
            date_default_timezone_set("Asia/Dhaka");
            
            $request->validate([
               'title' => ['required', 'string', 'max:255'],
               'slug' => ['required', 'string', 'min:2', 'max:255', 'Unique:posts'],
                'short_description' => ['required', 'string', 'min:2', 'max:500'],
                'description' => ['required'],
                'meta_description' => ['required', 'string', 'min:2', 'max:500'],
                'publish_status' => ['required','boolean'],
                'is_sticky' => ['boolean'],
                'allow_comments' => ['boolean'],
                'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                'category_id' => ['required', 'numeric'],
                'tags' => ['required'],
            ]);

            $post = new Post;
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->short_description = $request->short_description;
            $post->description = $request->description;
            $post->meta_description = $request->meta_description;
            $post->category_id = $request->category_id;
            $post->publish_status = $request->publish_status;
            $post->is_sticky = $request->is_sticky ? $request->is_sticky : 0;
            $post->allow_comments = $request->allow_comments ? $request->allow_comments : 0;
            $post->featured_image = $request->featured_image ? $request->featured_image : NULL;
            $post->published_at = date("Y-m-d H:i:s");
            $post->user_id = auth()->id();
            $post->save();

            if($request->has('tags')){
                $tags = explode(",", $request->tags);
                $tags_id = [];

                foreach($tags as $tag){
                    $tag_model = Tag::firstOrCreate(['title'=>$tag, 'slug'=>Str::slug($tag)]);
                    if($tag_model){
                        array_push($tags_id, $tag_model->id);
                    }
                }
                $post->tags()->sync($tags_id);
            }

            return redirect(route('admin.all-post'))->with('message', 'Post Created Successfully');
        }
}
