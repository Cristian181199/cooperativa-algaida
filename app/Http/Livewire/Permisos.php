<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permisos extends Component
{

    public $openCreate = false;
    public $openEdit = false;

    public $name, $permiso;

    protected $rules = [
        'permiso.name' => 'required|min:4|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'El nombre del permiso no puede estar vacio.',
        'name.min' => 'El nombre del permiso ha de tener minimo 4 caracteres.',
    ];

    protected $listeners = ['render', 'delete'];

    public function render()
    {
        return view('livewire.permisos.index', [
            'permisos' => Permission::all(),
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:4|string|max:255',
        ]);

        Permission::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        $this->reset(['openCreate', 'name']);

        $this->emitUp('render');
        $this->emit('success', 'Permiso creado!' ,'El permiso ha sido creado con exito!');
    }

    public function edit(Permission $permiso)
    {
        $this->permiso = $permiso;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->permiso->save();

        $this->reset('openEdit');

        $this->emit('success', 'Permiso editado!' ,'Permiso editado con exito!',);
    }

    public function delete(Permission $permiso)
    {
        $permiso->delete();
    }
}
