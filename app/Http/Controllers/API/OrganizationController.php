<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GroupResource;
use App\Models\Category;
use App\Models\Group;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrganizationResource;

class OrganizationController extends Controller
{
    /**
     * @return OrganizationResource|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            if (Auth::user()->organization_id === null) {
                return response()->json(['success' => false], 500);
            }
            return new OrganizationResource(Auth::user()->organization());
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param int $id
     * @return OrganizationResource
     */
    public function getById(int $id)
    {
        try {
            $org = Organization::find($id);
            return new OrganizationResource($org);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $domain
     * @return OrganizationResource|\Illuminate\Http\JsonResponse
     */
    public function getByDomain(string $domain)
    {
        try {
            $org = Organization::where('domain', '=', $domain)->get();
            if ($org === null) {
                return response()->json(['success' => false], 500);
            }
            return new OrganizationResource($org);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @return GroupResource|\Illuminate\Http\JsonResponse
     */
    public function groups()
    {
        try {
            $groups = Group::where('orgaization_id', '=', Auth::user()->organization_id)->get();
            return new GroupResource($groups);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        return $this->getCategories(Auth::user()->organization_id);
    }

    /**
     * @param int $orgId
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    public function categoriesById(int $orgId)
    {
        return $this->getCategories($orgId);
    }

    /**
     * @param int $orgId
     * @return CategoryResource|\Illuminate\Http\JsonResponse
     */
    private function getCategories(int $orgId)
    {
        try {
            $cats = Category::where('organization_id', '=', $orgId)->get();
            return new CategoryResource($cats);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}