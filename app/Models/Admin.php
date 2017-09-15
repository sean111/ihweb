<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    protected $hidden = [
        'password',
    ];

    public function organization()
    {
        return $this->belongsTo('organizations');
    }
}
