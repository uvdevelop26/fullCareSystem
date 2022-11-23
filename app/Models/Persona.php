<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'nombres',
        'apellidos',
        'ci_numero',
        'fecha_nacimiento',
        'telefono',
        'edad',
        'sexo',
        'paise_id',
        'ciudade_id'
    ];

    //relación uno a muchos inversa
    public function ciudade()
    {
        return $this->belongsTo('App\Models\Ciudade');
    }

    //relacion uno a muchos inversa

    public function paise()
    {
        return $this->belongsTo('App\Models\Paise');
    }

    //relacion uno a muchos
    public function residentes()
    {
        return $this->hasMany(Residente::class, 'persona_id');
    }

    //relacion uno a uno
    public function familiars()
    {
        return $this->hasMany('App\Models\Familiar');
    }

    //relacion uno a uno
    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado');
    }
}
