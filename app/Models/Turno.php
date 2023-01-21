<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    protected $fillable = [
        'turno',
        'empleado_id'
    ];



    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    //relacion muchos a muchos
    public function dias()
    {
        return $this->belongsToMany(Dia::class);
    }
}
