<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceGate
{
    /**
     * Routes that should be excluded from maintenance gate.
     */
    protected array $except = [
        'maintenance',
        'maintenance-bypass',
        'maintenance-lock',
        'login',
        'logout',
    ];

    /**
     * Handle an incoming request.
     *
     * If maintenance mode is enabled and the user has not bypassed it,
     * redirect them to the maintenance page.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if maintenance mode is enabled
        if (!config('app.maintenance_mode', true)) {
            return $next($request);
        }

        // Allow excluded routes
        foreach ($this->except as $route) {
            if ($request->is($route) || $request->is($route . '/*')) {
                return $next($request);
            }
        }

        // Allow authenticated admin users (if they've logged in via /login)
        if ($request->user()) {
            return $next($request);
        }

        // Allow users who have bypassed maintenance via password
        if ($request->session()->get('maintenance_bypass') === true) {
            return $next($request);
        }

        // Redirect to maintenance page
        return redirect()->route('maintenance');
    }
}
