<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSection extends Model
{
    use HasFactory;

    protected $table = 'hero_sections';

    protected $fillable = [
        'type',
        'hero_with_video',
        'hero_with_images',
    ];

    /**
     * Cast JSON columns to array automatically
     */
    protected $casts = [
        'hero_with_video' => 'array',
        'hero_with_images' => 'array',
        'type' => 'integer',

    ];

    /**
     * Check if this hero section is type video
     */
    public function isVideo(): bool
    {
        return $this->type === 2;
    }

    /**
     * Check if this hero section is type images
     */
    public function isImages(): bool
    {
        return $this->type === 1;
    }
}
