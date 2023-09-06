<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'profile_id' => $request->input('profile_id'),
        ]);
        
        
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profile_id' => $request->input('profile_id'),
        ]);

    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($loginData)) {
            return response(['message' => 'Invalid credentials'], 401);
        }
        return response(Auth::user());
    }
}
