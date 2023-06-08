<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    protected $redirectTo = '/dash';

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
            //dd(auth()->user()->is_admin==0);
            if (auth()->user()->is_admin==1){
                return redirect()->route('do.index');
            }else{
                return redirect()->route('guest.index');
            }

        }
        return redirect()->route('login.page')
            ->with('message','Почтаи электрони ва пароли Шумо нодуруст аст!');
    }

    public function logoute(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.page');
    }
}
