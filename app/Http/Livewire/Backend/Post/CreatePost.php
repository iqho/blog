<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Tag;
use App\Models\Admin\Post;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CreatePost extends Component
{

    use WithFileUploads;
    public $title;
    public $slug;
    public $description;
    public $featured_image;
    public $post;


    public function render()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();

        $data['checkEmpty'] = Str::length($this->slug);
        $data['checkSlug'] = Post::where('slug', '=', Str::slug($this->slug))->exists();

        return view('livewire.backend.post.create-post', compact('data'));
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

    // Ck Image Upload Code
    public function imageUpload(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        if ($request->hasFile('upload')) {
           // $originName = $request->file('upload')->getClientOriginalName();
            //$fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $currentDateTime = date("His-dmY");
            $fileName = $currentDateTime . '.' . $extension;
            $request->file('upload')->storeAs('media', $fileName, 'public');
            //$request->file('upload')->move(public_path('media'), $fileName);
            Media::create(['title'=>$currentDateTime, 'slug'=>$currentDateTime, 'media_name'=>$fileName, 'user_id'=>auth()->id(), 'media_type' => 'images']);
            $url = asset('storage/media/' . $fileName);
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
                 //'publish_status' => ['required','boolean'],
                 'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
                 'category_id' => 'required|numeric',
                 'tags' => 'required',
            ]);

            $slug = Str::slug($request->slug);
            $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
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
        
            if (auth()->user()->user_type == 1 || auth()->user()->user_type == 2 || auth()->user()->user_type == 3) {
            $post->publish_status = $request->publish_status ? $request->publish_status : 2;
            $post->is_sticky = $request->is_sticky ? $request->is_sticky : 0;
            }
            else{
            $post->publish_status = 0;
            $post->is_sticky =  0;
            }

            $post->post_order = $request->post_order ? $request->post_order : 0;
            $post->allow_comments = $request->allow_comments ? $request->allow_comments : 0;
            $post->featured_image = $newImageName;
            $post->published_at = date("Y-m-d H:i:s");
            $post->user_id = auth()->id();
            $post->save();

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

            if(Gate::allows('isAdmin')){
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Created Successfully');
            }
            elseif(Gate::allows('isEditor')){
            return redirect(route('admin-panel.all-posts'))->with('message', 'Post Created Successfully');
            }
            elseif(Gate::allows('isAuthor')){
            return redirect(route('author.all-posts'))->with('message', 'Post Created Successfully');
            }
            else{
            return redirect(route('contributor.all-posts'))->with('message', 'Post Created Successfully');
            }
            

        }

}

