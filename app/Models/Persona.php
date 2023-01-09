<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci_numero',
        'fecha_nacimiento',
        'telefono',
        'edad',
        'sexo',
        'direccion',
        'ciudade_id'
    ];

    

    //Relacion de uno a muchos
    public function ciudade()
    {
        return $this->belongsTo(Ciudade::class);
    }

    public function familiares()
    {
        return $this->hasMany(Familiare::class);
    }

    public function residentes()
    {
        return $this->hasMany(Residente::class);
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
