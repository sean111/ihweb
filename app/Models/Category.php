<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function organization()
    {
        return $this->belongsTo('organization');
    }

    public function parent()
    {
        return $this->belongsTo('categories');
    }

    public function children()
    {
        return $this->hasMany('categories', 'parent_id', 'id');
    }
}
