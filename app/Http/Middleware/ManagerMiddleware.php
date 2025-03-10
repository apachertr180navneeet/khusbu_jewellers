<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ManagerMiddleware
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
            if($user->role == "manager") {
                return $next($request);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->route('manager.login');
        }
    }
}
