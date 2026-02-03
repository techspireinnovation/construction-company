<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{    use SoftDeletes;

    protected $fillable = [
        'job_title',
        'slug',
        'employment_type',
        'experience_required',
        'education_level',
        'salary_range',
        'shift_duration',
        'short_summery',
        'description',
        'requirements', // This will store JSON
        'responsibilities', // This will store JSON
        'application_deadline',
        'banner_image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'employment_type' => 'integer',
        'education_level' => 'integer',
        'requirements' => 'array', // Auto-casts JSON to array
        'responsibilities' => 'array', // Auto-casts JSON to array
        'application_deadline' => 'date',
    ];

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class, 'reference_id')
                    ->where('type', 4); // Use the SEO_TYPE constant
    }
}