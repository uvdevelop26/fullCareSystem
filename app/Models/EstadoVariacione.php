<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoVariacione extends Model
{
    use HasFactory;

    protected $table = 'estado_variaciones';

    protected $fillable = ['nombre_estado'];


     //Mutadores y Accesores
     public function setNombreEstadoAttribute($value)
     {
         $this->attributes['nombre_estado'] = strtolower($value);
     }
     
     public function getNombreEstadoAttribute($value)
     {
         return ucwords($value);
     }

    //relacion de uno a muchos 
    public function vacaciones()
    {
        return $this->hasMany(Vacacione::class);
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }
}
