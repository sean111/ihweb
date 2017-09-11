<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'email', 'domain'];

    protected function users()
    {
        return $this->hasMany('users');
    }
}
