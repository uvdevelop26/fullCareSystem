<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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


    //Mutadores y Accesores
    protected function nombres(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    protected function apellidos(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    //Mutadores y Accesores

    protected function sexo(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

    //Relacion de uno a muchos
    public function ciudade()
    {
        return $this->belongsTo(Ciudade::class);
    }

    public function familiares()
    {
        return $this->hasMany(Familiare::class);
    }

    //relación de uno a muchos con residentes
    public function residentes()
    {
        return $this->hasMany(Residente::class);
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
