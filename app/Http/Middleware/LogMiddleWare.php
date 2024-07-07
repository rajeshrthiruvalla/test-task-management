<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Log;
class LogMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->route()->uri()=="api/login")
        {
            Log::channel('auth')->info($request->route()->uri(), $request->all());
        }else{
            Log::channel('auth')->info($request->route()->uri(), (array)auth()->user());
        }
        return $next($request);
    }
}
