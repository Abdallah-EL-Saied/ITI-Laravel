<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        $rolesArray = array_map('strtolower', explode(',', $roles));

        $userRole = strtolower($request->user()->role);

        if (!in_array($userRole, $rolesArray)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
