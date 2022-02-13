<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;

class EditPost extends Component
{
    use WithFileUploads;
    public $title, $slug, $short_description, $description, $meta_description, $category_id, $publish_status, $is_sticky, $allow_comments, $featured_image, $featured_image2, $post;
    public $checkMode = false;

    public function mount($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->short_description = $post->short_description;
        $this->description = $post->description;
        $this->meta_description = $post->meta_description;
        $this->category_id = $post->category_id;
        $this->publish_status = $post->publish_status;
        $this->is_sticky = $post->is_sticky;
        $this->allow_comments = $post->allow_comments;
        $this->featured_image = $post->featured_image;
       // $post->published_at = date("Y-m-d H:i:s");
       return $this->post = $post;
    }

    public function render()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();
        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkSlug'] = Post::where('slug', '=', Str::slug($this->slug))->exists();

        return view('livewire.backend.post.edit-post', compact('data'));
    }

    public function generateSlug()
    {
        $this->checkMode = true;
        if (Str::length($this->title) == 0) {
            $myslug = '';
        } else {
            $slug = Str::slug($this->title);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
            $newCount = $count > 0 ? ++$count : '';
            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        }
        return $this->slug = $myslug;
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

    public function updatePost(Request $request)
        {
        date_default_timezone_set("Asia/Dhaka");

           $request->validate([
                 'title' => ['required', 'string', 'max:255'],
                 'slug' => ['required', 'string', 'min:2', 'max:255'],
                 'short_description' => ['required', 'string', 'min:2', 'max:500'],
                 'description' => 'required',
                 'meta_description' => ['required', 'string', 'min:2', 'max:500'],
                 'publish_status' => ['required','boolean'],
                 'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                 'category_id' => 'required|numeric',
                 'tags' => 'required',
            ]);
            $post_id = $request->post_id;
            if($post_id){
                $post = Post::findOrFail($post_id);

                    if (!empty($request->featured_image2)) {

                        if ($request->slug !== $post->slug) {
                            $slug = Str::slug($request->slug);
                            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
                            $newCount = $count > 0 ? ++$count : '';
                            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
                        } else {
                            $myslug = $request->slug;
                        }

                        File::delete([public_path('storage/post-images/' . $post->featured_image)]); // Delete Old Image and Store New Image

                        $newImageName = $myslug . "." . $request->featured_image2->extension();
                        $request->featured_image2->storeAs('post-images', $newImageName, 'public');

                        $post->update([
                            'title' => $request->title,
                            'slug' => $myslug,
                            'short_description' => $request->short_description,
                            'description' => $request->description,
                            'meta_description' => $request->meta_description,
                            'featured_image' => $newImageName,
                            'category_id' => $request->category_id,
                            'publish_status' => $request->publish_status,
                            'is_sticky' => $request->is_sticky ? $request->is_sticky : 0,
                            'allow_comments' => $request->allow_comments ? $request->allow_comments : 0,
                            'published_at' => date("Y-m-d H:i:s"),
                            'user_id' => auth()->id(),
                        ]);
                    }
                    else{
                        if ($request->slug !== $post->slug) {
                            $slug = Str::slug($request->slug);
                            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
                            $newCount = $count > 0 ? ++$count : '';
                            $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;

                            if ($post->featured_image != null && empty($post->featured_image2)) {
                                $path_info = pathinfo(public_path('storage/post-images/' . $post->featured_image));
                                $getExt = $path_info['extension'];
                                $newImgName = $myslug . "." . $getExt;
                                $currentPath = (public_path('storage/post-images/' . $post->featured_image));
                                $newPath = (public_path('storage/post-images/' . $newImgName));
                                File::move($currentPath, $newPath); // If Change Slug than change also image name too
                            }

                            $post->update([
                                'title' => $request->title,
                                'slug' => $myslug,
                                'short_description' => $request->short_description,
                                'description' => $request->description,
                                'meta_description' => $request->meta_description,
                                'featured_image' => $newImgName,
                                'category_id' => $request->category_id,
                                'publish_status' => $request->publish_status,
                                'is_sticky' => $request->is_sticky ? $request->is_sticky : 0,
                                'allow_comments' => $request->allow_comments ? $request->allow_comments : 0,
                                'published_at' => date("Y-m-d H:i:s"),
                                'user_id' => auth()->id(),
                            ]);
                        } else {
                            $post->update([
                                'title' => $request->title,
                                'slug' => $request->slug,
                                'short_description' => $request->short_description,
                                'description' => $request->description,
                                'meta_description' => $request->meta_description,
                                'category_id' => $request->category_id,
                                'publish_status' => $request->publish_status,
                                'is_sticky' => $request->is_sticky ? $request->is_sticky : 0,
                                'allow_comments' => $request->allow_comments ? $request->allow_comments : 0,
                                'published_at' => date("Y-m-d H:i:s"),
                                'user_id' => auth()->id(),
                            ]);
                        }
                    }

                if($request->has('tags')){
                    $tags = explode(",", $request->tags);
                    $tags_id = [];

                    foreach($tags as $tag){
                        $tag_model = Tag::where('slug', Str::slug($tag))->first();
                        if($tag_model){
                            array_push($tags_id, $tag_model->id);
                        }
                        else{
                            $tag_model2 = Tag::create(['title' => $tag, 'slug' => Str::slug($tag), 'user_id' => auth()->id()]);
                            array_push($tags_id, $tag_model2->id);
                        }
                    }
                    $post->tags()->sync($tags_id);
                }
            }

            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Updated Successfully');

        }


}
