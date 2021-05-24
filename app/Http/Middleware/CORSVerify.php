<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORSVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = $request->header('Origin');
        $domains = ['http://127.0.0.1:5500'];
        if ($origin && collect($domains)->contains($origin)){
            return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin);
        } else {
            return response()->json(["error" => 'CORS error!!'], 404)->header('Access-Control-Allow-Origin', $domains[0]);
        }
    }
}
