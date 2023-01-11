<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$data)
    {
        if (Auth::guard('web')->check()) {
                if(!Auth::guard('web')->user()->checkPermission($data)){
                    if($request->expectsJson()) {
                        return response()->json(['error' =>"Access Denied"]);
                    }else{
                        return redirect()->back()->with('errors',"Access Denied");   
                    }
                }
            return $next($request);
        }

        return redirect()->back()->with('errors',["Access Denied"]);
    }
}
