<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() ){
            if(Auth::user()->type=="2") {
                return $next($request);
            }else{
                return redirect()->back();
            }
        }
        Auth::logout();
        return redirect('admin      ');
    }
}
