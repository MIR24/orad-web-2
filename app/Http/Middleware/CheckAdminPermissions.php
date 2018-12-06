<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckAdminPermissions
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
        if (empty($user)
            || (
                !$user->hasAnyRole(config('permission.super-admin-name'))
                && !$user->hasAnyPermission('see_admin_interface')
            )
        ) {
            throw UnauthorizedException::forRolesOrPermissions([config('permission.super-admin-name'), 'see_admin_interface']);
        }

        return $next($request);
    }
}
