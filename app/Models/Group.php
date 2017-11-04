<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'code', 'organization_id'];

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
