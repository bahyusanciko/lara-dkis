<?php

namespace App\Http\Middleware;

use Closure;

class isAdminMaster
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
        // dd(\Auth::user()->admin->is_master);
        // auth()->user()
        if (\Auth::user()->admin->is_master == 1){
            return $next($request);
        }
        else{
            abort(403);
           
        }
    }
}
