<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'banner_image',
        'status'
    ];
    // In Service model
public function seoDetail()
{
    return $this->hasOne(SeoDetail::class, 'reference_id')
                ->where('type', 3); // Assuming 3 is for services
}
}
