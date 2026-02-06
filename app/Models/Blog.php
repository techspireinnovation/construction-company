<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'banner_image',
        'short_description',
        'description',
        'blog_category_id',
        'written_by',
        'status'
    ];

    // Blog belongs to a category
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    // Blog has one SEO detail
    public function seo()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')
            ->where('type', 2);
    }
}
