<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'media_name', 'caption', 'alt', 'description', 'media_type', 'extension', 'user_id'];
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function findNext($id)
{
    return static::where('id', '>', $id)->first();
}

}
