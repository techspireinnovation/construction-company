<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SeoDetail extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;


    protected $table = 'seo_details';

    protected $fillable = [
        'reference_id',
        'type',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image',
    ];

    protected $casts = [
        'seo_keywords' => 'array', // JSON column will be cast to array automatically
    ];

    /**
     * Polymorphic relationship helper for models using SEO details
     */
    public function reference()
    {
        return $this->morphTo(null, 'type', 'reference_id');
    }
}
