<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckIfSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if (empty($user) || (!$user->hasAnyRole(config('permission.super-admin-name')) && !$user->can('see_users'))) {
            throw UnauthorizedException::forRoles([config('permission.super-admin-name')]);
        }

        return $next($request);
    }
}
