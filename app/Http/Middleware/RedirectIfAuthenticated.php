<?php

namespace App\Http\Middleware;

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
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            $authenticatedUser = Auth::guard($guard)->user();

            if ($authenticatedUser) {
                if (method_exists($authenticatedUser, 'getIsAdminAttribute') ? $authenticatedUser->isAdmin : ($authenticatedUser->role ?? null) === 'admin') {
                    return redirect()->route('personas.index');
                }

                return redirect()->route('dashboard');
            }
        }

        return $next($request);
    }
}
