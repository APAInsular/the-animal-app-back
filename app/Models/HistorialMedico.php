<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';

    protected $fillable = [
        'animal_id',
        'fecha',
        'descripcion',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
