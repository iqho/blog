<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'meta_description', 'tags', 'featured_image', 'user_id', 'publish_status', 'is_sticky', 'views', 'page_order'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
