<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Productos extends Component
{

    use WithFileUploads;

    public $openCreate = false;
    public $openEdit = false;
    public $openShow = false; // Falta el show

    public $denominacion, $imagen, $imagen_nueva;

    public $producto;

    protected $listeners = ['render', 'delete'];

    protected $rules = [
        'producto.denominacion' => 'required|min:4|string|max:100',
        'imagen_nueva' => 'nullable|sometimes|image|mimes:png,jpg|max:2048',
    ];

    public function render()
    {
        return view('livewire.productos.index', [
            'productos' => Producto::all(),
        ]);
    }

    public function save()
    {

        $this->validate([
            'denominacion' => 'required|min:4|string|max:100',
            'imagen' => 'required|image|mimes:png,jpg|max:2048',
        ]);

        // Si la validacion falla, no llega hasta aqui

        Producto::create([
            'denominacion' => $this->denominacion,
            'imagen' => Storage::disk('s3')->put('productos', $this->imagen, 'public'), // Aqui a la vez de guardarse el path de la imagen de S3, se sube la imagen a S3.
        ]);

        $this->reset(['openCreate', 'denominacion', 'imagen']);

        $this->emit('render');
        $this->emit('success', 'Producto creado!' ,'El producto ha sido creado con exito!');

    }

    public function edit(Producto $producto)
    {
        $this->producto = $producto;
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->imagen_nueva) {
            // Borramos la imagen anterior del bucket de S3
            Storage::disk('s3')->delete($this->producto->imagen);
            // Subimos la nueva imagen y le asociamos el path.
            $this->producto->imagen = Storage::disk('s3')->put('productos', $this->imagen_nueva, 'public');
        }

        $this->producto->save();

        $this->reset(['openEdit', 'denominacion', 'imagen', 'imagen_nueva']); // Falta imagen

        $this->emit('render');
        $this->emit('success', 'Producto editado!' ,'El producto ha sido editado con exito!');
    }

    public function delete(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('s3')->delete($producto->imagen);
        }
        $producto->delete();
    }
}
