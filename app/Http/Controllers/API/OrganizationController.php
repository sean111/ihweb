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
use Illuminate\Http\Request;

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
            return new OrganizationResource(Auth::user()->organization);
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
            $org = Organization::where('domain', '=', $domain)->first();
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
        return $this->getGroups(Auth::user()->organization_id);
    }

    /**
     * @param int $orgId
     * @return GroupResource|\Illuminate\Http\JsonResponse
     */
    public function groupsById(int $orgId)
    {
        return $this->getGroups($orgId);
    }

    /**
     * @param int $id
     * @return GroupResource|\Illuminate\Http\JsonResponse
     */
    public function getGroups(int $id)
    {
        try {
            $groups = Group::where('orgaization_id', '=', $id)->get();
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        if (!\in_array(Auth::user()->role, ['dev', 'admin'])) {
            return response()->json(['succes' => false, 'message' => 'Access Denied'], 401);
        }
        try {
            $data = json_decode($request->getContent(), true);
            $validate = \Validator::make($data, [
                'name' => 'required|string|unique:organizations,name',
                'email' => 'required|email',
                'domain' => 'required|string',
                'primary_color' => 'string|min:6',
                'secondary_color' => 'string|min:6',
                'tertiary_color' => 'string|min:6'
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(), 500);
            }
            $organization = new Organization($data);
            $organization->save();
            return response()->json(['success' => true, 'data' => $organization]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(int $id, Request $request)
    {
        if (!\in_array(Auth::user()->role, ['dev', 'admin'])) {
            return response()->json(['succes' => false, 'message' => 'Access Denied'], 401);
        }
        try {
            $data = json_decode($request->getContent(), true);
            $organization = Organization::findOrFail($id);
            $organization->update($data);
            $organization->save();
            return response()->json(['success' => true, 'data' => $organization]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}