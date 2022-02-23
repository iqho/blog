<?php

namespace App\Models\Admin;

use App\Models\Admin\Tag;
use App\Models\Admin\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'short_description', 'description', 'meta_description', 'featured_image', 'category_id', 'user_id', 'publish_status', 'is_sticky', 'allow_comments', 'views', 'post_order', 'published_at'];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
    return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
