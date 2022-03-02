<?php

namespace App\Http\Livewire\Backend\Comment;

use Livewire\Component;
use App\Models\Admin\Comment;
use Illuminate\Http\Request;

class AllComment extends Component
{
    public function render()
    {
        $all_comments = Comment::where('parent_id', null)->where('comment_status', 1)->orderBy('id', 'desc')->get();
        return view('livewire.backend.comment.all-comment', compact('all_comments'));
    }
    public function inactiveComments()
    {
        $all_comments = Comment::where('parent_id', null)->where('comment_status', 0)->orderBy('id', 'desc')->get();
        return view('livewire.backend.comment.all-inactive-comment', compact('all_comments'));
    }

    public function store(Request $request)
    {
    	$request->validate([
            'comment_body'=>'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        return back();
    }
}
