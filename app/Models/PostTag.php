<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostTag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
