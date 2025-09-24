<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            if ($request->is('company/*')) {
                return route('company.login');
            }
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('company.login'); // fallback
        }
        return null;
    }
}
