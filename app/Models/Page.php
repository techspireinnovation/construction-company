<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'page_type_id',
        'content',
        'status',
        'menu',
        'image',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'seo_image',
        'created_by',
        'page_type',
    ];

    protected $casts = [
        'status' => 'boolean',
        'menu' => 'boolean',
        'image' => 'array', // JSON column
    ];

    public function sections()
    {
        return $this->hasMany(PageContent::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function pageType()
    {
        return $this->belongsTo(PageType::class, 'page_type_id');
    }
}



