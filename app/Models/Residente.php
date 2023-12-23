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
    'habitacione_id'
  ];


  //relacion uno a muchos  (pertenece a)
  public function persona()
  {
    return $this->belongsTo(Persona::class);
  }


  public function habitacione()
  {
    return $this->belongsTo(Habitacione::class);
  }

  public function estados()
  {
    return $this->hasMany(EstadoResidente::class);
  }

  //relación de uno a muchos (tiene varios)

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

  public function rutinas()
  {
    return $this->hasMany(Rutina::class);
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
    });
  }
}
