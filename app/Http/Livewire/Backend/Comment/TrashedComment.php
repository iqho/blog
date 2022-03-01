<?php

namespace App\Http\Livewire\Backend\Comment;

use Livewire\Component;
use App\Models\Admin\Comment;

class TrashedComment extends Component
{
    public function render()
    {
        $all_comments = Comment::onlyTrashed()->where('parent_id', null)->orderBy('id', 'desc')->get();
        return view('livewire.backend.comment.trashed-comment', compact('all_comments'));
    }
}
