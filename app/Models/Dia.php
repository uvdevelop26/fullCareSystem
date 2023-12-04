<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;

    protected $table = 'dias';

    protected $fillable = [
        'nombre_dias'
    ];

     //Mutadores y Accesores
     public function setNombreDiasAttribute($value)
     {
         $this->attributes['nombre_dias'] = strtolower($value);
     }
     
     public function getNombreDiasAttribute($value)
     {
         return ucwords($value);
     }

    //relacion de muchos a muchos
    public function jornadas()
    {
        return $this->belongsToMany(Jornada::class);
    }
}
