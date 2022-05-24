<?php

namespace App\Http\Livewire;

use App\Models\Factura;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FacturasSocio extends Component
{

    public $openShow;

    public function render()
    {
        return view('livewire.facturas-socio.index', [
            'facturas' => Factura::whereBelongsTo(Auth::user())
                          ->withCount('suministros')
                          ->withSum('suministros', 'precio')
                          ->get(),
        ]);
    }

    public function show(Factura $factura)
    {
        $this->openShow = true;
        $this->factura = $factura;
    }
}
