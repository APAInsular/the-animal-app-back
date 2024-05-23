<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
// made by Harkaitz

class Rol extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'permisos_id',
        'permiso_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'permisos_id' => 'integer',
        'permiso_id' => 'integer',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function permiso(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }

    public function permisos(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }
}
