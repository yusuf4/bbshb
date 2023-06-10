<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     *
     */
    /** @var App\Models\User $user */

    public function handle(Request $request, Closure $next)
    {
            // admin role = 1
            // user role = 0
            /*dd(Auth::user());
            if (auth()->user()->is_admin==1){
                return $next($request);
            }else{
                return redirect()->route('guest.index')->with('message', 'You hav not access');
            }*/
        return $next($request);

    }

}
