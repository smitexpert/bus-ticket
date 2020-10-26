<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAgentPasswordNotUpdated
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
        
        if(!Auth::guard('agent')->check())
        {
            return redirect(route('agent.login'));
        }

        if(auth('agent')->user()->updated_at == null)
        {
            return redirect(route('agent.login.change.password'));
        }


        return $next($request);
    }
}
