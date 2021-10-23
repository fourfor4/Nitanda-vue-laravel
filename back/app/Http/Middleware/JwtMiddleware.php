<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use Illuminate\Support\Facades\Log;


class JwtMiddleware extends BaseMiddleware
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
        Log::info([$request]);
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['status' => 'User Not Found', 'success' => false], 200);
            };
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid', 'success' => false], 200);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired', 'success' => false], 200);
            } else {
                return response()->json(['status' => 'Authorization Token not found', 'success' => false], 200);
            }
        }
        return $next($request);
    }
}
