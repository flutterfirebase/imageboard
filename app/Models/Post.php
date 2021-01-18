<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable = [
        'board_id',
        'post_id',
        'parent_id',
        'content',
        'image',
        'is_deleted',
        'subject',
        'name',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function replies()
    {
        return $this->hasMany(Post::class, 'parent_id');
    }
}
