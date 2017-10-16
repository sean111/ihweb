<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category')->withTimestamps();
    }
}
