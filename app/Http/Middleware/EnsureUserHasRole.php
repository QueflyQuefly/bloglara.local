<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Auth;
 
class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! Auth::check() || ! $request->user()->hasRole($role)) {
            return abort(404);
        }

        return $next($request);
    }
}
