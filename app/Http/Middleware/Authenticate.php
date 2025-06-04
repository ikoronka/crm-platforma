<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->routeIs('coach.*') || $request->is('coach/*')) {
            return route('coach.login.show');
        }

        return route('student.login.show');
    }
}
