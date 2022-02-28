<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SideWidget extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'body', 'user_id', 'reorder', 'position'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
