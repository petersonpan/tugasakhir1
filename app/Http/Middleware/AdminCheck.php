<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        if(!session()->has('adminData')){
            return redirect('admin/login')->with('error','You must logged in');


        }
            return $next($request);
    }

    // public function handle(Request $request, Closure $next)
    // {
    //     if(session()->has('adminData')){
    //         //dd(Auth::user()->isAdmin());
            
    //         return $next($request);

    //     }
    //     return redirect('admin/login')->with('error','You must logged in');
        
    // }
}
