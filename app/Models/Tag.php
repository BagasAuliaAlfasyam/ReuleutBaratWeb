<?php

namespace App\Models;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function post_tag()
    {
        return $this->hasMany(PostTag::class);
    }
}
