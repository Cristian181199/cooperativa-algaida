<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    /**
     * Obtiene la clase a la que pertenece el producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clase(): BelongsTo
    {
        return $this->belongsTo(Clase::class);
    }

    /**
     * Obtiene todas las cargas(inventario) en la que aparece el producto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cargas(): HasMany
    {
        return $this->hasMany(Inventario::class);
    }
}
