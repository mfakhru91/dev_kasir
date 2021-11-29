<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\BaseController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticate
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
        $baseController = new BaseController;
        $token = Auth::guard('api')->check();
        if (!$token) {
            return $baseController->sendError('Unauthorised.', ['error' => 'Unauthorised'],401);
        }
        return $next($request);
    }
}
