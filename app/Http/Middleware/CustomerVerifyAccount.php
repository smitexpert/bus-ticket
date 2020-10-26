<?php

namespace App\Http\Middleware;

use Closure;

class CustomerVerifyAccount
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
        if(!auth('customer')->user())
        {
            return redirect(route('customer.login'));
        }

        if(auth('customer')->user()->status == 0)
        {
            return redirect(route('customer.account.verify.post'));
        }

        return $next($request);
    }
}
