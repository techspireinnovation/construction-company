<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [
        'title', 'description', 'image', 'status', 'seo_title', 'seo_image', 'seo_keywords', 'seo_description'
    ];

    /**
     * Get the blogs associated with this category.
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }
}