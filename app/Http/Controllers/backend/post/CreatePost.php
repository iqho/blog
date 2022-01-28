<?php

namespace App\Http\Controllers\backend\post;

use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class CreatePost extends Controller
{
    public function create()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();

      //  $data['checkEmpty'] = Str::length($this->slug);
        //$data['checkSlug'] = Post::where('slug', '=', Str::slug($this->slug))->exists();

        return view('backend.post.create-post', compact('data'));
    }

    // public function generateSlug()
    // {
    //     $slug = Str::slug($this->title);
    //     $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
    //     $newCount = $count > 0 ? ++$count : '';
    //     $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
    //     return $this->slug = $myslug;
    // }

    public function storePost()
        {
            date_default_timezone_set("Asia/Dhaka");
           dd($this->title, $this->slug, $this->short_description, $this->description, $this->meta_description, $this->category_id, $this->tags, $this->publish_status, $this->isStiky, $this->allow_comments);
            // $validatedDate = $this->validate([
            //    'title' => ['required', 'string', 'max:255'],
            //    'slug' => ['required', 'string', 'min:2', 'max:255'],
            //     'short_description' => ['required', 'string', 'min:2', 'max:500'],
            //     'description' => ['required'],
            //     'meta_description' => ['required', 'string', 'min:2', 'max:500'],
            //     'publish_status' => ['required'],
            //     //'featured_image' => ['nullable|featured_image|mimes:jpg,jpeg,png,svg,gif|max:2048'],
            //     'category_id' => ['required', 'numeric'],
            //     'tags' => ['required'],
            // ]);

            // $slug = Str::slug($this->slug);
            // $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
            // $newCount = $count > 0 ? ++$count : '';
            // $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

            // if (!empty($this->featured_image)) {
            //     $newImageName = $myslug.".".$this->featured_image->extension();
            //     $this->featured_image->storeAs('post-images', $newImageName, 'public');
            //     //$imageurl = url('storage') . '/' . $image;
            // } else {
            //     $newImageName = "default-feature-image.png";
            // }
            //     Post::create([
            //         'title' => $this->title,
            //         'slug' => $myslug,
            //         'short_description' => $this->short_description,
            //         'description' => $this->description,
            //         'meta_description' => $this->meta_description,
            //         'featured_image' => $newImageName,
            //         'user_id' => auth()->id(),
            //         'category_id' => $this->category_id,
            //         'published_at' => date("Y-m-d H:i:s"),
            //         //'category_id' => $this->parent_id ? $this->parent_id : NULL,
            //     ], $validatedDate);
                //dd(date("Y-m-d H:i:s"));
                //return redirect(route('admin.all-post'))->with('message', 'Post Created Successfully');
               // session()->flash('message', 'Category Created Successfully.');
                //$this->resetInputFields();
               // $this->emit('storeCategory');




        //    $post = Post::create([
        //         'title' => $request->get('title'),
        //         'body'  => $request->get('body')
        //    ]);

        //    if($post)
        //    {
        //        $tagNames = explode(',',$request->get('tags'));
        //         $tagIds = [];
        //         foreach($tagNames as $tagName)
        //         {
        //             //$post->tags()->create(['name'=>$tagName]);
        //             //Or to take care of avoiding duplication of Tag
        //             //you could substitute the above line as
        //             $tag = App\Tag::firstOrCreate(['name'=>$tagName]);
        //             if($tag)
        //             {
        //             $tagIds[] = $tag->id;
        //             }

        //         }
        //         $post->tags()->sync($tagIds);
        //     }
        }
}
