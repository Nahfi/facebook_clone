<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class test
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
      
            
            if (Auth::user()) {
                return redirect()->route("dashboard");
            }
         
         

        return $next($request);
    }
}
