<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    protected $messages = [
        '*.required' => 'El campo no puede estar vacio.',
        '*.min' => 'El campo ha de tener minimo 4 caracteres',
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

    public function save()
    {

        $this->validate([
            'name' => 'required|min:4|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'roles_seleccionados' => 'required|exists:roles,name',
        ]);

        // Si la validacion falla, no llega hasta aqui

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->roles_seleccionados);

        $this->reset(['openCreate', 'name', 'email', 'password', 'password_confirmation', 'roles_seleccionados']);

        $this->emit('render');
        $this->emit('success', 'Usuario creado!' ,'El usuario ha sido creado con exito!');

    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->openEdit = true;
    }

    public function update()
    {
        $password_nueva = trim($this->password);

        if (!(is_null($password_nueva) || empty($password_nueva))) {
            $this->rules['password'] = 'required|string|min:6|confirmed';
            $this->rules['password_confirmation'] = 'required|string|min:6|same:password';
            $this->validate();
            $this->user->password = Hash::make($password_nueva);
        }

        $this->validate();
        $this->user->save();

        if ($this->roles_seleccionados != null || !empty($this->roles_seleccionados)) {
            $this->rules['roles_seleccionados'] = 'required|exists:roles,name';
            $this->user->syncRoles($this->roles_seleccionados);
        }



        $this->reset(['openEdit', 'roles_seleccionados', 'password', 'password_confirmation']);

        $this->emit('render');
        $this->emit('alert-edit');
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
