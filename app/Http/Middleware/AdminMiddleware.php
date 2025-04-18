<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()) {
            $user = Auth::user();
            if($user->role == "super admin") {
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->route('admin.login');
        }
    }
}
