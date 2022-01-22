<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'meta_description', 'tags', 'featured_image', 'user_id', 'publish_status', 'is_sticky', 'allow_comments', 'views', 'page_order', 'published_at'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
