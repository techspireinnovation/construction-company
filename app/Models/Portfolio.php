<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'portfolios';

    protected $fillable = [
        'title',
        'slug',
        'portfolio_category_id',
        'partner_id',
        'banner_image',
        'short_description',
        'description',
        'images',
        'start_date',
        'end_date',
        'project_status',
        'status',
    ];

    protected $casts = [
        'images' => 'array', // automatically decode/encode JSON
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'boolean',
        'project_status' => 'integer',
    ];

    // Relationship to Portfolio Category
    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class, 'portfolio_category_id');
    }

    // Relationship to Partner
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    // Relationship to SEO
    public function seo()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')->where('type', 5);
    }
    

}
