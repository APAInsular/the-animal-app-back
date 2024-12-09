<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idAnimal',
        'Description',
        'Superpower',
        'DateOfBirth',
        'DateOfDeath',
        'race_id',
        'zone_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'DateOfBirth' => 'date',
        'DateOfDeath' => 'date',
        'race_id' => 'integer',
        'zone_id' => 'integer',
    ];

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function clinicalHistories(): HasMany
    {
        return $this->hasMany(ClinicalHistory::class);
    }

    public function microchips(): HasMany
    {
        return $this->hasMany(Microchip::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function needs(): BelongsToMany
    {
        return $this->belongsToMany(Needs::class);
    }

    public function feedings(): BelongsToMany
    {
        return $this->belongsToMany(Feeding::class);
    }

    public function cares(): BelongsToMany
    {
        return $this->belongsToMany(Care::class);
    }
}
