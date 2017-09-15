<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'organization_id'];
    
    public function parent()
    {
        return $this->belongsTo('groups', 'id', 'parent_id');
    }
}
