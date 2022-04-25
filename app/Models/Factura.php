<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Factura extends Model
{
    use HasFactory;

    /**
     * Obtiene el usuario al que pertenece la factura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene los suministros que pertenecen a la factura.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suministros(): BelongsToMany
    {
        return $this->belongsToMany(Suministro::class, 'factura_linea', 'factura_id', 'suministro_id');
    }
}
