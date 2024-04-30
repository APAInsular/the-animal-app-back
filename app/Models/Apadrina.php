<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apadrinamiento extends Model
{
    use HasFactory;

    // Asegúrate de que la tabla corresponda a tu base de datos
    protected $table = 'apadrinamientos';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'padrino_id',
        'animal_id',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'padrino_id' => 'integer',
        'animal_id' => 'integer',
    ];

    /**
     * Obtiene el padrino asociado con el apadrinamiento.
     */
    public function padrino(): BelongsTo
    {
        return $this->belongsTo(Padrino::class);
    }

    /**
     * Obtiene el animal asociado con el apadrinamiento.
     */
    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}
