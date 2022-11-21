<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    use HasFactory;

    protected $table = 'residentes';

    protected $fillable = [
      'foto',
      'fecha_ingreso',
      'fecha_salida',
      'persona_id'
    ];

    //relación uno a uno inversa
    public function persona()
    {
       return $this->belongsTo(Persona::class, 'persona_id');
    }

    //relacion uno a muchos
    public function familiars()
    {
       return $this->hasMany('App\Models\Familiar');
    }

    //relación mucho a muchos
    public function pensiones()
    {
      return $this->belongsToMany('App\Models\Pensione');
    }

    //relacion muchos a muchos

    public function medicamentos()
    {
      return $this->belongsToMany('App\Models\Medicamento');
    }
}
