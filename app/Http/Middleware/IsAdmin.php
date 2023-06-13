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
            // admin role = 1
            // user role = 0
            //dd(Auth::user());
          /*  if (auth()->check() && auth()->user()->is_admin == 1){
                return $next($request);
            }else{
                return redirect()->route('guest.index')->with('message', 'You hav not access');
            }*/

        /*$admin = Auth::id();
        dd($admin);
        if(!empty($admin)){
            if (is_admin == 1) {
                return $next($request);
                //return view('adminPage');
            }
        } else {

            // do whatever you want if authentication doesn't exist
        }; */
        return $next($request);

    }

}
