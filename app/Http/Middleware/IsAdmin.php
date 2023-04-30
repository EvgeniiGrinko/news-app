<?php

namespace App\Http\Middleware;

use App\Exceptions\CRUDException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()?->is_admin !== 1 && $request->user()?->tokenCan('news:command')){

            return response()->json("Unauthorized", 401);
        }

        return $next($request);
    }
}
