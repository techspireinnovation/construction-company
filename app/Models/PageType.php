<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    protected $fillable = ['name', 'status'];

    public function pages()
    {
        return $this->hasMany(Page::class, 'page_type_id');
    }
}