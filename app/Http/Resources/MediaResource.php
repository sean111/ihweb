<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MediaResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'file' => $this->path,
            'size' => $this->size,
            'organization' => $this->organization,
            'category' => $this->category,
            'created_at' => $this->created_at->format('m/d/Y h:ia'),
            'updated_at' => $this->updated_at->format('m/d/Y h:ia')
        ];
    }
}