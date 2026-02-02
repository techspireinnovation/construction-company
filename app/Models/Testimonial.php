<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'testimonials';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'designation',
        'message',
        'image',
        'status',
    ];

    
}
