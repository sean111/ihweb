<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FirebaseAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $errorMessage = 'Not authorized';
        $errorCode = 401;
        $apiKey = 'AIzaSyAcakBCFW_yg7DIorj_Icgj056BLkVXtyM';
        try {
            $authToken = str_replace('Bearer', null, $request->headers->get('Authorization'));
            if ($authToken === null) {
                throw new \InvalidArgumentException('No authentication token found');
            }
            Log::info('[Firebase Auth] => ' . $authToken);
            $serviceAccount = ServiceAccount::fromJsonFile(config_path() . '/firebase.json');
            $firebase = (new Factory)->withServiceAccountAndApiKey($serviceAccount, $apiKey)->create();
            $auth = $firebase->getAuth();
            $token = $auth->verifyIdToken($authToken);
            $userId = $token->getClaim('user_id');
            $user = User::where('firebase_uid', $userId)->firstOrFail();
            if (empty($user)) {
                throw new \InvalidArgumentException('No user found');
            }
            Auth::loginUsingId($user->id);
        } catch (\Throwable $e) {
            Log::error('[Firebase Auth] => ' . $e->getMessage());
            return response()->json($errorMessage, $errorCode);
        }
        return $next($request);
    }
}
