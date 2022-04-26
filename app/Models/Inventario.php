<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventario extends Model
{
    use HasFactory;

    /* Las relaciones se entienden mejor si se ve la clase Inventario
       como linea de inventario */
    /**
     * Obtiene el usuario al que pertenece el inventario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ususario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el producto al que pertenece el inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    /**
     * Obtiene la subasta a la que pertenece el inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subasta(): BelongsTo
    {
        return $this->belongsTo(Subasta::class);
    }
}
