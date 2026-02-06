<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'mission',
        'vision',
        'stats',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'mission' => 'array',
        'vision' => 'array',
        'stats' => 'array',
    ];
}
