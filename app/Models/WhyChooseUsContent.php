<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsContent extends Model
{
    protected $table = 'why_choose_us_contents';
    protected $fillable = ['choose_us_id', 'title'];

    public function whyChooseUs()
    {
        return $this->belongsTo(WhyChooseUs::class, 'choose_us_id');
    }
}