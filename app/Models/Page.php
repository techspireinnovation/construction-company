<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $table = 'pages';

    protected $fillable = [
        'type',
        'banner_image',
        'status',
        'order_no',

    ];

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')
            ->where('type', 6); // 6 = pages
    }
}
