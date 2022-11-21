<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    public function empleado()
    {
        return $this->belongsTo('App\Models\Empleado');
    }
}
