<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;
use App\Role;
use Backpack\Base\app\Models\BackpackUser as User;

class CheckIfSuperAdminCanBeAssigned
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
        if (preg_match('/admin\/user\/\d+/', $request->path()) && ($request->isMethod('post') || $request->isMethod('put'))) {
            $superAdminName = config('permission.super-admin-name');
            $superAdminRole = Role::where('name', $superAdminName)->first();
            if (empty($superAdminRole)) {
                throw UnauthorizedException::forRoles([$superAdminName]);
            }

            if (($request->has('roles') && in_array($superAdminRole->id, $request->input('roles'))) || ($request->has('roles_show') && in_array($superAdminRole->id, $request->input('roles_show'))) || (User::find($request->input('id'))->hasAnyRole($superAdminName))
                ) {
                $user = $request->user();
                if (empty($user) || !$user->hasAnyRole($superAdminName)) {
                    throw UnauthorizedException::forRoles([$superAdminName]);
                }
            }
        }

        return $next($request);
    }
}
