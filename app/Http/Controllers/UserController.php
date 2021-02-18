<?php

namespace App\Http\Controllers;

use App\GruposUsuarios;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->temAcesso('profile.edit');
        return view('users.index', ['users' => User::all()]);
    }

    public function pesquisa()
    {
        $data = request()->all();
        $users = User::whereRaw('1 = 1');
        if (isset($data['q']) and $data['q'])
            $users
                ->where('name', 'like', '%' . $data['q'] . '%')
                ->orWhere('username', 'like', '%' . $data['q'] . '%')
                ->orWhere('email', 'like', '%' . $data['q'] . '%');
        return view('users.table', ['users' => $users->get()]);
    }

    public function create()
    {
        $this->temAcesso('profile.edit', 'C');
        return view('users.create', ['gruposusuarios' => GruposUsuarios::all()]);
    }

    public function store(UserRequest $r)
    {
        $data = $r->all();
        $this->save($data);
        flash("Usuário {$data['name']} cadastrado com sucesso")->success();
        return $this->rindex();
    }

    public function edit($user)
    {
        $user = User::findOrFail($user);
        return view('users.edit', ['user' => $user, 'gruposusuarios' => GruposUsuarios::all()]);
    }

    protected function save(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'grupos_usuarios_id' => $data['grupos_usuarios_id']
        ]);
    }

    public function rindex()
    {
        return redirect('user');
    }

    public function destroy(User $user)
    {
        $this->temAcesso('profile.edit', 'E');
        $user->delete();
        return $this->rindex();
    }

    public function update(UserRequest $r, $user)
    {
        $data = $r->all();
        if (!$data['password'])
            unset($data['password']);
        else
            $data['password'] = Hash::make($data['password']);

        $usuario = User::findOrFail($user);
        $usuario->update($data);
        return $this->rindex();
    }

}
