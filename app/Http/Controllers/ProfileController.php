<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return $profiles;
    }

    // public function create()
    // {
    //     return view('profiles.create');
    // }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        Profile::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('profiles.index')->with('success', 'Perfil criado com sucesso.');
    }

    public function show(Profile $profile)
    {
        return $profile;
    }

    // public function edit(Profile $profile)
    // {
    //     return view('profiles.edit', compact('profile'));
    // }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $profile->update([
            'name' => $request->input('name'),
        ]);

    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
    }
}
