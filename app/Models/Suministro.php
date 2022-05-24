<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Suministro extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'codigo',
        'denominacion',
        'precio',
        'imagen',
    ];

    /**
     * The facturas that belong to the Suministro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facturas(): BelongsToMany
    {
        return $this->belongsToMany(Factura::class, 'factura_linea', 'suministro_id', 'factura_id');
    }
}
