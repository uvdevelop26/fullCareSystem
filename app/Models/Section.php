<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    //relacion uno a muchos
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado');
    }
}
