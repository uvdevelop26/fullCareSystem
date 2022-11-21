<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    //relacion uno a mucho inversa
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    //relacion uno a muchos inversa
    public function sueldo()
    {
        return $this->belongsTo('App\Models\Sueldo');
    }

    //relacion uno a uno inversa
    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    //relacion uno a muchos
    public function permisos()
    {
        return $this->hasMany('App\Models\Permiso');
    }
}
