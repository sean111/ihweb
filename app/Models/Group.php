<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'code', 'organization_id'];

    public function parent()
    {
        return $this->belongsTo('groups', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('groups', 'parent_id', 'id');
    }
}
