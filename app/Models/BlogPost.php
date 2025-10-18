<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;
    // In your BlogPost model
    public function getExcerptAttribute() {
        return Str::words($this->content, 20);
    }

    protected $fillable = [
        'title',
        'user_id',
        'content',
        'author',
        'featured_image',
        'category',
        'tags',
    ];

    public function scopeFilter($query, array $filters) {
        // Apply filters to the search query
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('content', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('category', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('tags', 'like', '%' . $filters['search'] . '%');
        }

        // Apply filters to the tags
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . $filters['tag'] . '%');
        }

        // Apply filters to the category
        if ($filters['category'] ?? false) {
            $query->where('category', 'like', '%' . $filters['category'] . '%');
        }

        // Apply filters to the author
        if ($filters['author'] ?? false) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }


        return $query;
    }

    // Relationship with User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    //Relationship with Category
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
