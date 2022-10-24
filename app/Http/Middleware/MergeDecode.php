<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Repositories\JwtRepository;

class MergeDecode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    protected $jwtRepository;

    public function __construct(JWTRepository $jwtRepository)
    {
        $this->jwtRepository = $jwtRepository;
    }
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('access-token');
        if ($token) {
            $result = $this->jwtRepository->decodeJwtToken($token);
            if (isset($result->tokenExpired)) {
                return response()->json([
                    'message' => 'Unauthorized access ! Token has been expired'
                ], 401);
            } else if (isset($result->invalidToken)) {
                return response()->json([
                    'message' => 'Unauthorized access ! Invalid token'
                ], 401);
            } else {
                if (isset($result->data)) {
                    $request->merge(['decoded' => $result->data]);
                    return $next($request);
                } else {
                    return response()->json([
                        'message' => 'Unauthorized access ! Invalid token data'
                    ], 401);
                }
            }
        } else {
            return response()->json([
                'message' => 'Unauthorized access'
            ], 401);
        }
    }
}
