<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'fecha_ingreso',
        'email',
        'profesion',
        'seccion_id',
        'persona_id'
    ];

    //relacion de uno a muchos
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function sueldos()
    {
        return $this->hasMany(Sueldo::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
