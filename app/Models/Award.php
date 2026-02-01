<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'Company_name', 'Company_logo', 'images', 'status'];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
    ];
}