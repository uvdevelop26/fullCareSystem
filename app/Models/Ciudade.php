<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ciudade extends Model
{
    use HasFactory;

    protected $table = 'ciudades';


    //Mutadores y Accesores
    public function setNombreCiudadAttribute($value)
    {
        $this->attributes['nombre_ciudad'] = strtolower($value);
    }

    public function getNombreCiudadAttribute($value)
    {
        return ucwords($value);
    }
    //relacion de uno a muchos
    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
