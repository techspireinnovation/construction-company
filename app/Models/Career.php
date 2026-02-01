<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $table = 'careers';
    protected $fillable = ['title', 'company_name', 'company_location', 'employment_type', 'salary_range', 'shift_type', 'short_description', 'description', 'requirements', 'job_type', 'company_logo', 'posted_date', 'responsibilities', 'status'];
    protected $casts = [
        'status' => 'boolean',
        'posted_date' => 'date',
    ];
}