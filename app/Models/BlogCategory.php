<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'status',
    ];
    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')
            ->where('type', 1); // Assuming 3 is for services
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'blog_category_id')
            ->where('status', 1)
            ->whereNull('deleted_at'); // optional, only active blogs
    }
}
