<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public $fillable = [
        'url',
        'name',
        'tagline',
    ];

    public function threads()
    {
        return $this->hasMany(Post::class);
    }
}
