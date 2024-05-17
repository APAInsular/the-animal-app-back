<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    use HasFactory;

    protected $table = 'vacunaciones';

    protected $fillable = ['nombre', 'fecha', 'animal_id'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
