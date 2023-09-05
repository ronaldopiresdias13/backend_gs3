<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Listar todos os usuários (para administradores)
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // Exibir formulário de criação de usuário (para administradores)
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Salvar um novo usuário no banco de dados (para administradores)
        // Valide os dados recebidos antes de salvar
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'profile_id' => $request->input('profile_id'),
        ]);
        
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    public function edit(User $user)
    {
        // Exibir formulário de edição de usuário (para administradores)
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Atualizar informações do usuário (para administradores)
        // Valide os dados recebidos antes de atualizar
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profile_id' => $request->input('profile_id'),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $user)
    {
        // Excluir um usuário (para administradores)
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
