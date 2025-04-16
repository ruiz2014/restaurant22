<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        // dd(Auth::user());
        if(Auth::check() && Auth::user()->rol <= 2) {
        // if(Auth::check()) {
            return $next($request);
        }
        // return redirect('/admin');
        // return $next($request);
        // return redirect('/home')->with('message', ['danger', 'No eres Admin no tienes privilegios para acceder']);
        return redirect()->back()->with('danger', 'No eres Admin no tienes privilegios para acceder');
    }
}