<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CreatePost extends Component
{

    use WithFileUploads;
    //public $publish_status = 1;
    //public $is_sticky = 0;
    //public $allow_comments = 1;
    //public $title, $slug, $short_description, $description, $meta_description, $featured_image, $tags, $category_id;

    public function render()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();

        //$data['checkEmpty'] = Str::length($this->slug);
        //$data['checkSlug'] = Post::where('slug', '=', Str::slug($this->slug))->exists();

        return view('livewire.backend.post.create-post', compact('data'));
    }

    // public function generateSlug()
    // {
    //     $slug = Str::slug($this->title);
    //     $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
    //     $newCount = $count > 0 ? ++$count : '';
    //     $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
    //     return $this->slug = $myslug;
    // }

    public function jsonTag(){
        $tagjson = Tag::orderBy('id', 'desc')->pluck('title')->limit(7);
        return $tagjson ;
    }

    // public function storePost(Request $request)
    //     {
    //         date_default_timezone_set("Asia/Dhaka");
    //        dd($this->title, $this->slug, $this->short_description, $this->description, $this->meta_description,$this->category_id, $request->tags, $this->publish_status, $this->is_sticky, $this->allow_comments);

    //        $this->validate([
    //             'title' => ['required', 'string', 'max:255'],
    //             'slug' => ['required', 'string', 'min:2', 'max:255', 'Unique:posts'],
    //              'short_description' => ['required', 'string', 'min:2', 'max:500'],
    //              'description' => ['required'],
    //              'meta_description' => ['required', 'string', 'min:2', 'max:500'],
    //              'publish_status' => ['required','boolean'],
    //              'is_sticky' => ['boolean'],
    //              'allow_comments' => ['boolean'],
    //              'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
    //              'category_id' => ['required', 'numeric'],
    //              'tags' => ['required'],
    //         ]);

    //         $slug = Str::slug($this->slug);
    //         $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
    //         $newCount = $count > 0 ? ++$count : '';
    //         $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

    //         if (!empty($this->featured_image)) {
    //             $newImageName = $myslug.".".$this->featured_image->extension();
    //             $this->featured_image->storeAs('post-images', $newImageName, 'public');
    //             //$imageurl = url('storage') . '/' . $image;
    //         } else {
    //             $newImageName = "default-feature-image.png";
    //         }

    //         $post = new Post;
    //         $post->title = $this->title;
    //         $post->slug = $myslug;
    //         $post->short_description = $this->short_description;
    //         $post->description = $this->description;
    //         $post->meta_description = $this->meta_description;
    //         $post->category_id = $this->category_id;
    //         $post->publish_status = $this->publish_status;
    //         $post->is_sticky = $this->is_sticky ? $this->is_sticky : 0;
    //         $post->allow_comments = $this->allow_comments ? $this->allow_comments : 0;
    //         $post->featured_image = $this->featured_image ? $this->featured_image : NULL;
    //         $post->published_at = date("Y-m-d H:i:s");
    //         $post->user_id = auth()->id();
    //         $post->save();

    //         // if($this->has('tags')){
    //         //     $tags = explode(",", $this->tags);
    //         //     $tags_id = [];

    //         //     foreach($tags as $tag){
    //         //         $tag_model = Tag::firstOrCreate(['title'=>$tag, 'slug'=>Str::slug($tag)]);
    //         //         if($tag_model){
    //         //             array_push($tags_id, $tag_model->id);
    //         //         }
    //         //     }
    //         //     $post->tags()->sync($tags_id);
    //         // }


    //         if($request->has('tags')){
    //             $tags = explode(",", $request->tags);
    //             $tags_id = [];

    //             foreach($tags as $tag){
    //                 $tag_model = Tag::firstOrCreate(['title'=>$tag, 'slug'=>Str::slug($tag)]);
    //                 if($tag_model){
    //                     array_push($tags_id, $tag_model->id);
    //                 }
    //             }
    //             $post->tags()->sync($tags_id);
    //         }

    //         return redirect(route('admin.all-post'))->with('message', 'Post Created Successfully');

    //             // Post::create([
    //             //     'title' => $this->title,
    //             //     'slug' => $myslug,
    //             //     'short_description' => $this->short_description,
    //             //     'description' => $this->description,
    //             //     'meta_description' => $this->meta_description,
    //             //     'featured_image' => $newImageName,
    //             //     'user_id' => auth()->id(),
    //             //     'category_id' => $this->category_id,
    //             //     'published_at' => date("Y-m-d H:i:s"),
    //             //     //'category_id' => $this->parent_id ? $this->parent_id : NULL,
    //             // ], $validatedDate);
    //             //return redirect(route('admin.all-post'))->with('message', 'Post Created Successfully');
    //     }

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

