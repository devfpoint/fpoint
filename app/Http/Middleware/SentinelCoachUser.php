<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelCoachUser
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
        $user = Sentinel::getUser();
        $coach = Sentinel::findRoleByName('Coaches');

        if (!$user->inRole($coach)) {
            return redirect('login');
        }
        return $next($request);
    }
}
