<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $table = 'testimonials';
    protected $fillable = ['name', 'designation', 'company_name', 'message', 'image', 'status'];
}