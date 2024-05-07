<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voluntario extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'disponibilidad',
        'idioma',
        'horario',
        'usuario_id',
        'formacion_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'disponibilidad' => 'date',
        'usuario_id' => 'integer',
        'formacion_id' => 'integer',
    ];

    public function tareas(): HasMany
    {
        return $this->hasMany(Tareas::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function formacion(): BelongsTo
    {
        return $this->belongsTo(Formacion::class);
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(\App\Models\DireccionUsuario::class);
    }
}
