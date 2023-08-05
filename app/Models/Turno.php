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

    public function jornadas(){
        return $this->hasMany(Jornada::class);
    }

}
