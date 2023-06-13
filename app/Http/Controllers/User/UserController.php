<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select( 'id','name', 'nasab', 'email', 'is_admin')->get();
        //$users = User::paginate(5,['id','name', 'nasab', 'email', 'is_admin']);
        //dd($users);
        return Inertia::render('Users/Index', [
            'users'=>$users
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Add');
    }

    public function store(UserRequest $request)
    {
        //$request->validated();
        User::create([
            'name' => $request->name,
            'nasab' => $request->nasab,
            'email' => $request->email,
            'is_admin' => intval($request->is_admin),
            'password' => Hash::make($request->password),
            ]);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $userID = User::findOrFail($id);
        return Inertia::render('Users/Edit',[
            'userID'=>$userID,
        ]);
    }

    public function update(Request $request, $id)
    {
        $updateUserData = $request->only(['name', 'nasab','email', 'is_admin']);
        if ($request->filled('password')){
            if ($request->filled('confirm_password')){
                $updateUserData['password']=Hash::make($request->password);
                //$updateUserData['confirm_password']=Hash::make$request->confirm_password;
            }
        }
        $user = User::findOrFail($id);
        $user->update($updateUserData);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index');

    }
}
