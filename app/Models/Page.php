<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Page extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pages';

    protected $fillable = [
        'type',
        'banner_image',
        'status',
        'order_no',
        'parent_id',
    ];

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')
            ->where('type', 6); // 6 = pages
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id')
            ->orderBy('order_no')
            ->with('children'); // Recursive eager loading
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get all descendants recursively
     */
    public function getDescendantsAttribute()
    {
        return $this->children()->with('descendants')->get();
    }

    /**
     * Scope to get root pages (no parent)
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}