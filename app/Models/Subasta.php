<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subasta extends Model
{
    use HasFactory;

    /*Se entienden mejor las relaciones si se ve la clase Subasta
      como linea de subasta.*/
    /**
     * Obtiene todas las cargas de la subasta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cargas(): HasMany
    {
        return $this->hasMany(Inventario::class);
    }

    /**
     * Obtiene todos los albaranes de la subasta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function albaranes(): HasMany
    {
        return $this->hasMany(Albaran::class);
    }
}
