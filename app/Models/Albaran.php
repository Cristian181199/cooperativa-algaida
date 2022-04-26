<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Albaran extends Model
{
    use HasFactory;

    protected $table = 'albaranes';

    /**
     * Obtiene la subasta a la que pertenece el albaran.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subasta(): BelongsTo
    {
        return $this->belongsTo(Subasta::class);
    }

    /**
     * Obtiene el usuario al que pertenece el albaran.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
