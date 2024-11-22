<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RouteNeedsPermission
{
    /**
     * The delimiter used to separate the permissions.
     *
     * @var string
     */
    const DELIMITER = '|';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $permissions
     * @param bool $requireAll
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions, $requireAll = false, $guard = null)
    {
        $permissions = explode(self::DELIMITER, $permissions);

        if (!is_bool($requireAll)) {
            $requireAll = filter_var($requireAll, FILTER_VALIDATE_BOOLEAN);
        }

        if (!access($guard)->hasPermissions($permissions, $requireAll)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
