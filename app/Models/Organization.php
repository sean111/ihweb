<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'email', 'domain', 'primary_color', 'secondary_color', 'tertiary_color'];

    protected function users()
    {
        return $this->hasMany(User::class);
    }
}
