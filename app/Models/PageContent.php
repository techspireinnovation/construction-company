<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'title',
        'subtitle',
        'text',
        'content',
        'link',
        'sectionimages',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'sectionimages' => 'array', // JSON column
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}