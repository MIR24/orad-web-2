<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\UnauthorizedException;

class NewUserGetSeeTabs
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
        if (preg_match('/admin\/user$/', $request->path()) && $request->isMethod('post')) {
            $permission = Permission::where('name', 'see_tabs')->first();
            if (empty($permission)) {
                return $next($request);
            }

            $changeFields = ['permissions', 'permissions_show'];

            foreach ($changeFields as $changeField) {
                if ($request->has($changeField)) {
                    if (!in_array($permission->id, $request->input($changeField))) {
                        $newPermissionsShow = $request->input($changeField);
                        $newPermissionsShow[] = $permission->id;
                        $request->request->add([$changeField => $newPermissionsShow]);
                    }
                } else {
                    $request->request->add([$changeField => [$permission->id]]);
                }
            }
        }

        return $next($request);
    }
}
