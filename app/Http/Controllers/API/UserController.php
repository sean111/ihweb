<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @return UserResource
     */
    public function index()
    {
        Log::info(Auth::user());
        return new UserResource(Auth::user());
    }

    /**
     * @param int $userId
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function get(int $userId)
    {
        try {
            $user = User::find($userId);
            return new UserResource($user);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required'
            ]);
            $firstName = $request->get('first_name');
            $lastName = $request->get('last_name');
            $user = Auth::user();
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->save();
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deactivate()
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            $user->status = 'inactive';
            $user->save();
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'organization_id' => 'required|integer',
                'firebase_uid' => 'required'
            ]);

            $user = User::where('email', $request->get('email'));

            if (!empty($user)) {
                return response()->json(['success' => false, 'message' => 'There is already a user with that email'], 500);
            }

            $user = new User;
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->organization_id = $request->get('organization_id');
            $user->firebase_uid = $request->get('firebase_uid');
            $user->role = 'user';
            $user->save();

            return response()->json(['success' => true, 'data' => $user]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}