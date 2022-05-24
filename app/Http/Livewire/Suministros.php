<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Suministros extends Component
{
    use WithFileUploads;

    public $openCreate = false;
    public $openEdit = false;
    public $openShow = false; //Falta el show

    public $codigo, $denominacion, $precio, $imagen, $imagen_nueva;

    public $suministro;

    protected $listeners = ['render', 'delete'];

    public function render()
    {
        return view('livewire.suministros.index', [
            'suministros' => Suministro::orderBy('codigo')->get(),
        ]);
    }

    // Si pongo aqui la validacion, no me da fallos para excluir el codigo del suministro a la hora de hacer el edit.
    protected function rules()
    {
        return [
            'suministro.codigo' => 'required|numeric|max:100|unique:suministros,codigo,' . $this->suministro->id, // con esto le decimos a la validacion
            'suministro.denominacion' => 'required|string|max:25',                                                    // unique que exceptue el codigo del suministro a editar.
            'suministro.precio' => 'required|numeric',
            'imagen_nueva' => 'nullable|sometimes|image|mimes:png,jpg|max:2048',
        ];
    }

    public function save()
    {

        $this->validate([
            'codigo' => 'required|string|max:100|unique:suministros,codigo',
            'denominacion' => 'required|string|max:25',
            'precio' => 'required|numeric',
            'imagen' => 'required|image|mimes:png,jpg|max:2048',
        ]);

        // Si la validacion falla, no llega hasta aqui

        Suministro::create([
            'codigo' => $this->codigo,
            'denominacion' => $this->denominacion,
            'precio' => $this->precio,
            'imagen' => \Storage::disk('s3')->put('suministros', $this->imagen, 'public'), // Aqui a la vez de guardarse el path de la imagen de S3, se sube la imagen a S3.
        ]);


        $this->reset(['openCreate', 'codigo', 'denominacion', 'precio', 'imagen']);

        $this->emit('render');
        $this->emit('success', 'Suministro creado!' ,'El suministro ha sido creado con exito!');

    }

    public function edit(Suministro $suministro)
    {
        $this->suministro = $suministro;
        $this->openEdit = true;
    }

    public function update()
    {

        $this->validate();

        if ($this->imagen_nueva) {
            // Borramos la imagen anterior del bucket de S3
            Storage::disk('s3')->delete($this->suministro->imagen);
            // Subimos la nueva imagen y le asociamos el path.
            $this->suministro->imagen = Storage::disk('s3')->put('suministros', $this->imagen_nueva, 'public');
        }

        $this->suministro->save();


        $this->reset(['openEdit', 'codigo', 'denominacion', 'precio', 'imagen_nueva']);
        $this->emit('render');
        $this->emit('success', 'Suministro editado!' ,'El suministro ha sido editado con exito!');
    }

    public function deleteCheck(Suministro $suministro)
    {
        if (!$suministro->facturas->isEmpty()) {
            $this->emit('error', 'El Suministro no se puede borrar por que existen facturas con este suministro!');
        } else {
            $this->emit('deleteSuministro', $suministro);
        }
    }

    public function delete(Suministro $suministro)
    {
        if ($suministro->imagen) {
            Storage::disk('s3')->delete($suministro->imagen);
        }

        $suministro->delete();

    }
}
