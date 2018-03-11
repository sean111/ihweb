<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrganizationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'domain' => $this->domain,
            'contact_email' => $this->email,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'tertiary_color' => $this->tertiary_color,
            'logo1' => 'https://' . env('AWS_BUCKET') . '.' . env('AWS_URL') . '/' . $this->logo1,
            'logo2' => 'https://' . env('AWS_BUCKET') . '.' . env('AWS_URL') . '/' . $this->logo2
        ];
    }
}
