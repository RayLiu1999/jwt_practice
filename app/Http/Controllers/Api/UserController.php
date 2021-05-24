<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    function login(Request $request){

        $user = $request->user();

        return response()->json([
            'jwt' => $this->getJWTToken($user)
        ]);
    }

    function logout(Request $request){
        $user = $request->user();
        $user_token_key = "user_token_{$user->id}";
        $cached_user_token = time();
        Cache::put($user_token_key, $cached_user_token);
        return response()->json(null);
    }

    private function getJWTToken(User $user) {

        $user_token_key = "user_token_{$user->id}";
        if (Cache::has($user_token_key)){
            $cached_user_token = Cache::get($user_token_key);
        } else {
            $cached_user_token = time();
            Cache::put($user_token_key, $cached_user_token);
        }

        $headers = ['alg'=>'HS256','typ'=>'JWT'];
        $payload = ["user"=> $user, "iat" => time(), 'user_token' => $cached_user_token];
        $encoded_headers = $this->base64url_encode(json_encode($headers));
        $encoded_payload = $this->base64url_encode(json_encode($payload));
        $key = env('JWT_KEY');
        $signature = $this->base64url_encode(
                hash_hmac('sha256',"$encoded_headers.$encoded_payload", $key, true )
            );
        return "$encoded_headers.$encoded_payload.$signature";
    }

    private function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
