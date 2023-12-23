<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'seccions';

    protected $fillable = [
        'nombre_seccion',
        'descripcion'
    ];

    protected function descripcion(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => strtolower($value)
        );
    }

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
