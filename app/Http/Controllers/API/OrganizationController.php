<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    public function index()
    {
        if (Auth::user()->organization_id === null) {
            return response()->json(['success' => false], 500);
        }
        return new OrganizationResource(Auth::user()->organization());
    }

    public function getById(int $id)
    {
        $org = Organization::find($id);
        return new OrganizationResource($org);
    }

    public function getByDomain(string $domain)
    {
        $org = Organization::where('domain', '=', $domain)->get();
        if ($org === null) {
            return response()->json(['success' => false], 500);
        }
        return new OrganizationResource($org);
    }
}