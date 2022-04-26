<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $openCreate = false;
    public $openEdit = false;

    public $name, $rol, $permiso_seleccionados = [];

    protected $rules = [
        'rol.name' => 'required|min:4|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'El nombre del rol no puede estar vacio.',
        'name.min' => 'El nombre del rol ha de tener minimo 4 caracteres.',
        'rol.name.required' => 'El nombre del rol no puede estar vacio.',
        'rol.name.min' => 'El nombre del rol ha de tener minimo 4 caracteres.',
    ];

    protected $listeners = ['render', 'delete'];

    public function render()
    {
        return view('livewire.roles.index', [
            'roles' => Role::with('permissions')->get(),
            'permisos' => Permission::all(),
        ]);
    }

    public function save()
    {

        $this->validate([
            'name' => 'required|min:4|string|max:255',
        ]);

        $rol_creado = Role::create([
            'name' => $this->name,
            'guard_name' => 'web'
        ]);

        if ($this->permiso_seleccionados != null || !empty($this->permiso_seleccionados)) {
            $this->rules['permiso_seleccionados'] = 'required|exists:permissions,name';
            $rol_creado->givePermissionTo($this->permiso_seleccionados);
        }

        $this->reset(['openCreate', 'name', 'permiso_seleccionados']);

        $this->emitUp('render');
        $this->emit('success', 'Rol creado!' ,'El rol ha sido creado con exito!');
    }

    public function edit(Role $rol)
    {
        $this->rol = $rol;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        $this->rol->save();

        if ($this->permiso_seleccionados != null || !empty($this->permiso_seleccionados)) {
            $this->rules['permiso_seleccionados'] = 'required|exists:roles,name';
            $this->rol->syncPermissions($this->permiso_seleccionados);
        }

        $this->reset('openEdit', 'permiso_seleccionados');
        // En realidad, no tendria que resetearse los checkboxs, ya que tendrian que aparecer seleccionados por defecto los permisos que ya tuviera el rol.

        $this->emit('success', 'Rol editado!' ,'El rol ha sido editado con exito!');

    }

    public function delete(Role $rol)
    {
        $rol->delete();
    }
}
