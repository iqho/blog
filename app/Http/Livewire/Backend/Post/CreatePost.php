<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Admin\Category;

class CreatePost extends Component
{

    use WithFileUploads;
    public $publish_status = 1;
    public $isStiky = 0;
    public $allow_comments = 1;
    public $title, $slug, $short_description, $full_description, $meta_description, $feature_image, $category_id;

    public function render()
    {
        $data['catOption'] = Category::where('parent_id', null)->orderBy('id', 'desc')->get();
        return view('livewire.backend.post.create-post', compact('data'));
    }

    public function generateSlug()
    {
        $slug = Str::slug($this->title);
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        $myslug = $newCount > 0 ? "$slug-$newCount" : $slug;
        return $this->slug = $myslug;
    }

    public function store()
        {
            //$active = $this->isActive ? '':'';
            dd($this->publish_status);
            //return redirect(route('admin.all-post'));
           // $post = Post::create([
                //'title' => $request->get('title'),
                //'body'  => $request->get('body')
           // ]);

           // if($post)
           // {
               // $tagNames = explode(',',$request->get('tags'));
                // $tagIds = [];
                // foreach($tagNames as $tagName)
                // {
                //     //$post->tags()->create(['name'=>$tagName]);
                //     //Or to take care of avoiding duplication of Tag
                //     //you could substitute the above line as
                //     $tag = App\Tag::firstOrCreate(['name'=>$tagName]);
                //     if($tag)
                //     {
                //     $tagIds[] = $tag->id;
                //     }

                // }
                // $post->tags()->sync($tagIds);
            //}
        }

}

