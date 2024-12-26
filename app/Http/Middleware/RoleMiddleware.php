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
// Check if user is authenticated with the correct guard
$user = Auth::guard('vendor')->user(); // Check if vendor is logged in
if (!$user) {
$user = Auth::guard('web')->user(); // Check if customer is logged in
}

// Ensure the user exists and has a matching role
if ($user && in_array($user->role_id, $roles)) {
return $next($request);
}

// Redirect or abort if unauthorized
return redirect()->route('user.home')->with('error', 'Unauthorized access.');
}
}