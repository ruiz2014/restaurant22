<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        // dd($guards, $request, $next);
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // dd(Auth::user()->rol);
                switch (Auth::user()->rol) {
                    case 1:
                        return redirect()->route('home');
                    case 2:
                        return redirect()->route('home');
                    default:
                        return redirect()->route('hall');
                }

                // dd($guards, $request, $guard, Auth::guard($guard)->check(), Auth::user()->rol);
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
