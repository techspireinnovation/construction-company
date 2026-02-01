<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhyChooseUs extends Model
{
    use SoftDeletes;

    protected $table = 'why_choose_us';
    protected $fillable = ['title', 'image', 'icon', 'status'];

    public function contents()
    {
        return $this->hasMany(WhyChooseUsContent::class, 'choose_us_id');
    }
}