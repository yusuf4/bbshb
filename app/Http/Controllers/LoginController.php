<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    //protected $redirectTo = '/dash';
    public function __construct()
    {
        $this->middleware('guest')->except('logoute');
    }

    public function showLogin(){
        return Inertia::render('LoginPage');
    }

    public function login(Request $request)
    {
        $credentials= $request->validate([
           'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            //return redirect()->route('do.index');
            if (auth()->user()->is_admin==1){
                return redirect()->route('dash.index');
            }else{
                return redirect()->route('guest.index');
            }

        }
        return redirect()->route('login')
            ->with('message','Почтаи электрони ва пароли Шумо нодуруст аст!');
    }

    public function logoute(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
