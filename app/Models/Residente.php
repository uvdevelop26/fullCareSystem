<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
  use HasFactory;

  protected $table = 'residentes';

  protected $fillable = [
    'foto',
    'fecha_ingreso',
    'persona_id',
    'estado_residente_id'
  ];


  //relacion uno a muchos con personas
  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }

  public function estado_residente()
  {
    return $this->belongsTo(EstadoResidente::class);
  }

  public function familiares()
  {
    return $this->hasMany(Familiare::class);
  }

  public function historiales()
  {
    return $this->hasMany(Historiale::class);
  }

  public function medicamentos()
  {
    return $this->hasMany(Medicamento::class);
  }


  //SCOPE PARA LAS BÚSQUEDAS
  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where(function ($query) use ($search) {
        $query->whereHas('persona', function ($query) use ($search) {
          $query->where('nombres', 'like', '%' . $search . '%')
            ->orWhere('apellidos', 'like', '%' . $search . '%')
            ->orWhere('ci_numero', 'like', '%' . $search . '%');
        });
      });
    })->when($filters['search_ciudad'] ?? null, function ($query, $search) {
      $query->where(function ($query) use ($search) {
        $query->whereHas('persona.ciudade', function ($query) use ($search) {
          $query->where('id', $search);
        });
      });
    })->when($filters['search_sexo'] ?? null, function ($query, $search) {
      $query->where(function ($query) use ($search) {
        $query->whereHas('persona', function ($query) use ($search) {
          $query->where('sexo', $search);
        });
      });
    })->when($filters['search_estado'] ?? null, function ($query, $search) {
      $query->where(function ($query) use ($search) {
        $query->whereHas('estado_residente', function ($query) use ($search) {
          $query->where('id', $search);
        });
      });
    });
  }
}
