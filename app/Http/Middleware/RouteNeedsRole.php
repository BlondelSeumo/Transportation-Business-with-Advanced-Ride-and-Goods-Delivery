<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RouteNeedsRole
{
    /**
     * The delimiter used to separate the roles.
     *
     * @var string
     */
    const DELIMITER = '|';

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $roles
     * @param bool $requireAll
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $requireAll = false, $guard = null)
    {
        $roles = explode(self::DELIMITER, $roles);

        if (!is_bool($requireAll)) {
            $requireAll = filter_var($requireAll, FILTER_VALIDATE_BOOLEAN);
        }

        if (!access($guard)->hasRoles($roles, $requireAll)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
