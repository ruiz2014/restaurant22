<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd(in_array($request->user()->rol, $roles));
        if(in_array($request->user()->rol, $roles)){
            return $next($request);
        }
        return redirect()->back()->with('danger', 'No tienes permisos para acceder');
        // return $next($request);
    }
}
