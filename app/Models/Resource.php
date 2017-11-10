<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;

class Resource extends Model
{
    protected $fillable = ['name', 'path', 'size', 'organization_id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
