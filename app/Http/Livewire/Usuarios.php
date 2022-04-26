<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Usuarios extends Component
{

    public $openCreate = false;
    public $openEdit = false;
    public $openShow = false;

    public $name, $email, $password, $password_confirmation;

    public $user;

    public $roles_seleccionados = [];

    protected $listeners = ['render', 'delete'];

    protected $rules = [
        'user.name' => 'required|min:4|string|max:255',
        'user.email' => 'required|string|email|max:255',
    ];



    public function render()
    {
        return view('livewire.usuarios.index', [
            'users' => User::with('roles')->get(),
            'roles' => Role::all(),
        ]);
    }

    public function show(User $user)
    {
        $this->openShow = true;
        $this->user = $user;
    }
}
