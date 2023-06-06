<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
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

    public function update(UserUpdateRequest $request, $id)
    {
       // dd($request);
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'nasab' => $request->nasab,
            //'email' => $request->email,
            'is_admin' => intval($request->is_admin),
        ]);
        if (!empty($request->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            }

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index');

    }
}
