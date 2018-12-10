<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Log;

class LogEverything
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
        $response = $next($request);

        if ($response->status() == 200) {
            $route = Route::currentRouteName();
            if (empty($route)) {
                $route = Route::currentRouteAction();
            }
            Log::info(
                $route . ' requested.',
                [
                    'user' => $request->user(),
                    'request-payload' => $request->all(),
                    'response-data' => $response->getContent()
                ]
            );
        }

        return $response;
    }
}
