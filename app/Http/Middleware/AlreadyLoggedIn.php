<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLoggedIn
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
        if(session()->has('adminData') && ( url('admin/login') == $request->url())  || ( url('admin/') == $request->url())){
            return redirect('admin/dashboard');    
        }
        return $next($request);
    }
}
