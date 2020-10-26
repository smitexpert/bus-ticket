<?php

namespace App\Http\Middleware;

use Closure;

class AgentApiRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role='super')
    {
        // If not logged in, redirect to the login page.
        // if (!auth('agent')->user()) {
        //     return redirect(route('agent.login'));
        // }

        $roles = auth('api')->user()->roles()->pluck('name');

        $given_role = explode(';', $role);

        $match = count(array_intersect($given_role, $roles->toArray()));

        if (!$match) {
            return response([
                'success' => false,
                'status' => 401,
                'message' => 'Unathorised Request',
                'data' => 'Unathorised Request'
            ], 401);
        }

        return $next($request);
    }
}
