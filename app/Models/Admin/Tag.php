<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'meta_description', 'tag_order'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class);
    // }

    public function posts()
        {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');

        }

}
