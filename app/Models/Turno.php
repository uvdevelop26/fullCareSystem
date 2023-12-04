<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    protected $fillable = [
        'nombre_turnos',
        'hora_entrada',
        'hora_salida',
    ];

    //Mutadores y Accesores
    public function setNombreTurnosAttribute($value)
    {
        $this->attributes['nombre_turnos'] = strtolower($value);
    }

    public function getNombreTurnosAttribute($value)
    {
        return ucwords($value);
    }

    public function jornadas()
    {
        return $this->hasMany(Jornada::class);
    }
}
