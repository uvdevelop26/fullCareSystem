<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    use HasFactory;

    protected $table = 'sueldos';

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
