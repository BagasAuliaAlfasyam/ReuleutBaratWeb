<?php

namespace App\Models;

use App\Models\User;
use App\Models\PostTag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = [
        'created_at',
        'published_at',
        'deleted_at'
    ];
    public function scopeSearch($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title_post', 'like', '%' . $search . '%')
                ->orWhere('body_post', 'like', '%' . $search . '%');
        });
        $query->when($filters['published'] ?? false, function ($query, $published) {
            return $query->where('published_at', 'like', '%' . $published . '%');
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });
        $query->when($filters['author'] ?? false, function ($query, $author) {
            return $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function post_tag()
    {
        return $this->hasMany(PostTag::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
