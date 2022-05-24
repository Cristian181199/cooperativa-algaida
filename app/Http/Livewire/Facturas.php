<?php

namespace App\Http\Livewire;

use App\Models\Factura;
use App\Models\Suministro;
use App\Models\User;
use Livewire\Component;

class Facturas extends Component
{

    public $openCreate = false;
    public $openEdit = false;
    public $openShow = false;

    public $codigo, $user_id;

    public $factura;

    public $suministros_seleccionados = [];

    protected $listeners = ['render', 'delete'];

    protected function rules()
    {
        return [
            'factura.codigo' => 'required|integer|unique:facturas,codigo,' . $this->factura->codigo,
            'factura.user_id' => 'required|integer|exists:users,id',
            'suministros_seleccionados' => 'required|exists:suministros,id',
        ];
    }

    public function render()
    {
        return view('livewire.facturas.index', [
            'facturas' => Factura::with('user')->withCount('suministros')->withSum('suministros', 'precio')->get(),
            'suministros' => Suministro::all(),
            'usuarios' => User::all(),
        ]);
    }

    public function show(Factura $factura)
    {
        $this->openShow = true;
        $this->factura = $factura;
    }

    public function save()
    {

        $this->validate([
            'codigo' => 'required|integer|unique:facturas,codigo',
            'user_id' => 'required|integer|exists:users,id',
            'suministros_seleccionados' => 'required|exists:suministros,id',
        ]);

        // Si la validacion falla, no llega hasta aqui

        $factura = Factura::create([
            'user_id' => $this->user_id,
            'codigo' => $this->codigo
        ]);

        $factura->suministros()->attach($this->suministros_seleccionados);

        $this->reset(['openCreate', 'codigo', 'user_id', 'suministros_seleccionados']);

        $this->emit('render');
        $this->emit('success', 'Factura creada!' ,'La factura ha sido creada con exito!');
    }

    public function edit(Factura $factura)
    {
        $this->factura = $factura;
        $this->suministros_seleccionados = $factura->suministros()->pluck('id', 'denominacion');
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate();
        $this->factura->save();

        if ($this->suministros_seleccionados != null || !empty($this->suministros_seleccionados)) {
            //$this->factura->suministros()->sync($this->suministros_seleccionados);
            // No consigo con el sync directamente que funcione al quitar el check de un suministro ya que retorna false y el sync se lia.
            $sumis_id = Suministro::whereIn('id', $this->suministros_seleccionados)->pluck('id');
            $this->factura->suministros()->sync($sumis_id);
        }



        $this->reset(['openEdit', 'suministros_seleccionados']);

        $this->emit('render');
        $this->emit('success', 'Factura editada!' ,'La factura ha sido editada con exito!');
    }

    public function delete(Factura $factura)
    {
        // Borramos de la tabla pivote y luego la factura.
        $factura->suministros()->detach();
        $factura->delete();
    }
}
