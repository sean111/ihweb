<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SecurityController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showLogin()
    {
        if (Auth::guest()) {
            return view('auth.login');
        }
        return redirect('/');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkLogin(Request $request)
    {
        try {
            $authToken = $request->input('token');
            Log::info('[Auth Login] => ' . $authToken);
            if (empty($authToken)) {
                throw new \InvalidArgumentException('No token found');
            }
            $serviceAccount = ServiceAccount::fromJsonFile(config_path() . '/firebase.json');
            $firebase = (new Factory)->withServiceAccount($serviceAccount)->create();
            $tokenHandler = $firebase->getTokenHandler();
            $token = $tokenHandler->verifyIdToken($authToken);
            $userId = $token->getClaim('user_id');
            Log::info('[Auth Login] => ' . $userId);
            $user = User::where('firebase_uid', $userId)->firstOrFail();
            Auth::guard('web')->loginUsingId($user->id);
            return response()->json(['success' => true, 'data' => Auth::user()]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 401);
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
}