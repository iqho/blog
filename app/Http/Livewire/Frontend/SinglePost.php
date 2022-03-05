<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Admin\Comment;
use Livewire\Component;
use App\Models\Admin\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SinglePost extends Component
{
    public $post, $comment_body, $post_id, $parent_id;

    protected $listeners = ['regeneratedCodes' => '$refresh'];

    public function mount($slug)
    {
        $post_slug_exist = Post::where('slug', $slug)->where('publish_status', 1)->first();
        if ($post_slug_exist) {
            $pid = $post_slug_exist->id;
            if (!(Session::get('id') == $pid)) {
                Post::where('id', $pid)->increment('views');
                Session::put('id', $pid);
            }
            return [$this->post = Post::where('slug', $slug)->where('publish_status', 1)->with('comments')->with('category')->first(), $this->post_id = $pid];           
        } 
        else {   
        return abort(404);   
    }

    }

    public function render()
    {
        return view('livewire.frontend.single-post')->layout('layouts.app');
    }

    private function resetInputFields()
    {
        $this->comment_body = '';
        $this->parent_id = '';
    }

    public function store()
    {
    	$this->validate([
            'comment_body'=>'required',
        ]);

        //$input = $request->all();
        $input['comment_body'] = $this->comment_body;
        $input['post_id'] = $this->post_id;
        $input['parent_id'] = $this->parent_id ? $this->parent_id : NULL;
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        $this->emit('regeneratedCodes');
       $this->resetInputFields();
       return redirect()->back();
    }

    public function storeReply(Request $request)
    {
        $request->validate([
            'comment_body'=>'required',
        ]);

        $input['comment_body'] = $request->comment_body;
        $input['post_id'] = $request->post_id;
        $input['parent_id'] = $request->parent_id ? $request->parent_id : NULL;
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        $this->emit('regeneratedCodes');
       $this->resetInputFields();
       return redirect()->back();
    }
}
