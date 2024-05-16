<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\HistorialMedico;
class Animal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'edad',
        'historia',
        'especie_id',
        'alimentacion_id',
        'cuidados_id',
        'necesidades_id',
        'tarea_id',
        'foto',
        'fecha_esterilizacion',
        'fecha_nacimiento',
        'fecha_llegada',
        'raza',
        'tipo',
        'microchip',
        'esterilizado',
        'zoocan',
        'cartilla',
        'desparasitacion',
        'superpoder',
        'descripcion'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'especie_id' => 'integer',
        'alimentacion_id' => 'integer',
        'cuidados_id' => 'integer',
        'necesidades_id' => 'integer',
        'tarea_id' => 'integer',
    ];



    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }

    public function alimentacion(): BelongsTo
    {
        return $this->belongsTo(Alimentacion::class);
    }

    public function cuidados(): BelongsTo
    {
        return $this->belongsTo(Cuidados::class);
    }

    public function necesidades(): BelongsTo
    {
        return $this->belongsTo(Necesidades::class);
    }

    public function tarea(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tareas::class);
    }
    public function historialesMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}
