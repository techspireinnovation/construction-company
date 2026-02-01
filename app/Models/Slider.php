<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{

    use SoftDeletes;
    protected $fillable=[
        'title',
        'sub_title',
        'content',
        'status',
        'order_no',
        'button_name',
        'button_link',       
        'feature_image'     
       
    ];
}
