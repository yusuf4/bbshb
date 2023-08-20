<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Auth;

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
            if (auth()->check() && auth()->user()->is_admin == 1){
                return $next($request);
            }
            return redirect()->route('guest.index')->with('message', 'Шумо ба саҳифаи Администратор дастрасӣ надоред!');
    }

}
