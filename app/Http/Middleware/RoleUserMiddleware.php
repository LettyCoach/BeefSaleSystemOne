<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): Response
    {
        if($request->user()->hasRole('admin')){
            return $next($request);
        } else {
            if(!$request->user()->hasRole($role)){
                return back()->with('status', 'NoRole');
                //return back::with('message', 'You must log in to continue');
            
            }
            return $next($request);
        }
    }
}
