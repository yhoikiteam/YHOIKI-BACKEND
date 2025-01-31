<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $role = $user->roles->first()->name;

                if ($role === 'admin') {
                    return redirect('dashboard/admin');
                } elseif ($role === 'yhoiki') {
                    return redirect('dashboard/yhoiki');
                } elseif ($role === 'user') {
                    return redirect('/dashboard/user');
                } else {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}