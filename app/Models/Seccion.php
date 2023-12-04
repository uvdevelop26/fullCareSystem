<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'seccions';

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }

    //Mutadores y Accesores
    public function setNombreSeccion($value)
    {
        $this->attributes['nombre_seccion'] = strtolower($value);
    }
    
    public function getNombreSeccionAttribute($value)
    {
        return ucwords($value);
    }
}
