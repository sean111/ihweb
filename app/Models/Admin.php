<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

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
        return $this->belongsTo(Organization::class);
    }
}
