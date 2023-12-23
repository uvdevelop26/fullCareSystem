<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Enfermedade extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';

    protected $fillable = [
        'nombre',
    ];

    public function historiales()
    {
        return $this->belongsToMany(Historiale::class);
    }

    //Mutadores y Accesores
    protected function nombre(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }
}
