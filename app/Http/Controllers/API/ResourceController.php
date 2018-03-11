<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function get(int $id)
    {
        try {
            $media = Resource::find($id);
            return new MediaResource($media);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}