<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //Admin
       if (Auth::guard('admin')->check()) {
         return redirect()->route('admin.index');
          //return redirect('admin/deshboard');
        }
              
        //user
        if (Auth::guard('web')->check()) {
            return redirect()->route('home.index');
         }

        return $next($request);
    }
}
