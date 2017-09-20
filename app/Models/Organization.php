<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'email', 'domain'];

    protected function users()
    {
        return $this->hasMany(User::class);
    }
}
