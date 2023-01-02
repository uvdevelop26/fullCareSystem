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
    'estado',
    'persona_id'
  ];

  //relacion uno a muchos
  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }

  public function familiares()
  {
    return $this->hasMany(Familiare::class);
  }
}
