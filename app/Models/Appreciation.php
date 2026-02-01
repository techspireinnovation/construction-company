<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appreciation extends Model
{
    use SoftDeletes;

    protected $table = 'appreciations';
    protected $fillable = ['name', 'designation', 'company_name', 'message', 'image', 'status'];
}