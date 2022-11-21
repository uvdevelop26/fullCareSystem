<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    use HasFactory;

    //Relación uno a muchos 
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
}
