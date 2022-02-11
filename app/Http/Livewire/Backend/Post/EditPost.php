<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;

class EditPost extends Component
{
    use WithFileUploads;
    public $featured_image, $post;

    public function mount($slug){
        return $this->post = Post::withTrashed()->where('slug', $slug)->first();
    }

    public function render()
    {
        return view('livewire.backend.post.edit-post');
    }

    public function generateSlug()
    {
        if(Str::length($this->title) == 0){
            $myslug = '';
        }
        else{
            $slug = Str::slug($this->title);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        return $this->slug = $myslug;
    }

    public function jsonTag(){
        $tagjson = Tag::orderBy('id', 'desc')->pluck('title')->take(7);
        return $tagjson ;
    }

    // Ck Image Upload Code
    public function imageUpload(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        if ($request->hasFile('upload')) {
           // $originName = $request->file('upload')->getClientOriginalName();
            //$fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = date("His-dmY") . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function storePost(Request $request)
        {
            date_default_timezone_set("Asia/Dhaka");

           $request->validate([
                 'title' => ['required', 'string', 'max:255'],
                 'slug' => ['required', 'string', 'min:2', 'max:255', 'Unique:posts'],
                 'short_description' => ['required', 'string', 'min:2', 'max:500'],
                 'description' => 'required',
                 'meta_description' => ['required', 'string', 'min:2', 'max:500'],
                 'publish_status' => ['required','boolean'],
                 'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                 'category_id' => 'required|numeric',
                 'tags' => 'required',
            ]);

            $slug = Str::slug($request->slug);
            $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

            if (!empty($request->featured_image)) {
                $newImageName = $myslug.".".$request->featured_image->extension();
                $request->featured_image->storeAs('post-images', $newImageName, 'public');
                //$imageurl = url('storage') . '/' . $image;
            } else {
                $newImageName = "default-feature-image.png";
            }

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
            $post->featured_image = $newImageName;
            $post->published_at = date("Y-m-d H:i:s");
            $post->user_id = auth()->id();
            $post->save();

           //dd($post);

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
