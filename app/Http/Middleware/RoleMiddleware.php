<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Check if user is authenticated and role matches
        if ($user && in_array($user->role_id, $roles)) {
            return $next($request);
        }

        // Redirect or abort if unauthorized
        return redirect()->route('theme.home')->with('error', 'Unauthorized access.');
    }
}