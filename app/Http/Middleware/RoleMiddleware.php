<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$role, $permission=null)
    {
        //echo $role;
        if(!$request->user()->hasRole($role)){
            abort(404);
        }

        if($permisssion !== null && !$request->user()->can($permisssion)){
            abort(404);
        }
        return $next($request);
    }
}
