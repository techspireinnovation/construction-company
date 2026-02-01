<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'image', 'short_description', 'long_description', 'status',
        'category_id', 'tags', 'seo_title', 'seo_image', 'seo_keywords',
        'seo_description', 'written_by', 'published_at', 'is_draft', 'view_count'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); // Adjust based on your author field
    }

    
}