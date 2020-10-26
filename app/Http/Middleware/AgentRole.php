<?php

namespace App\Http\Middleware;

use Closure;

class AgentRole
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
        if (!auth('agent')->user()) {
            return redirect(route('agent.login.show'));
        }

        $roles = auth('agent')->user()->roles()->pluck('name');

        $given_role = explode(';', $role);

        $match = count(array_intersect($given_role, $roles->toArray()));

        if (!$match) {
            return redirect(route('agent.home'));
        }

        return $next($request);
    }
}
