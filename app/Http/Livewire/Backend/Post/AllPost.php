<?php

namespace App\Http\Livewire\Backend\Post;

use Livewire\Component;
use App\Models\Admin\Post;

class AllPost extends Component
{
    public function render()
    {
        $data['posts'] = Post::with('category')->get();
        return view('livewire.backend.post.all-post', compact('data'));
    }

    public function store()
        {
            $post = Post::create([
                //'title' => $request->get('title'),
                //'body'  => $request->get('body')
            ]);

            if($post)
            {
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
            }
        }

}
