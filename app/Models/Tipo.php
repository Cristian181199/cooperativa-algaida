<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tipo extends Model
{
    use HasFactory;

    /**
     * Obtiene todas las parcelas a las que pertenece ese tipo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parcelas(): HasMany
    {
        return $this->hasMany(Parcela::class);
    }
}
