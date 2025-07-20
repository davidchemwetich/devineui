<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if user has the required role
        if (!$user->hasRole($role)) {
            return $this->redirectToCorrectDashboard($user);
        }

        return $next($request);
    }

    /**
     * Redirect user to their correct dashboard based on their role
     */
    private function redirectToCorrectDashboard($user)
    {
        if ($user->hasRole('admin')) {
            $prefix = config('app.admin_prefix', 'shield');
            return redirect()->route($prefix . '.dashboard')
                ->with('error', 'You do not have permission to access that area.');
        } elseif ($user->hasRole('support')) {
            return redirect()->route('support.dashboard')
                ->with('error', 'You do not have permission to access that area.');
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to access that area.');
        }
    }
}
