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
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            // Adicione outras validações para campos adicionais do perfil, se necessário
        ]);

        Profile::create([
            'name' => $request->input('name'),
            // Adicione outros campos do perfil aqui, se necessário
        ]);

        return redirect()->route('profiles.index')->with('success', 'Perfil criado com sucesso.');
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            // Adicione outras validações para campos adicionais do perfil, se necessário
        ]);

        $profile->update([
            'name' => $request->input('name'),
            // Atualize outros campos do perfil aqui, se necessário
        ]);

        return redirect()->route('profiles.index')->with('success', 'Perfil atualizado com sucesso.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Perfil excluído com sucesso.');
    }
}
