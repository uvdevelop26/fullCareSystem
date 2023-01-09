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

  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? null, function ($query, $search) {
      $query->where(function ($query) use ($search) {
        $query->where('id', 'like', '%' . $search . '%');
          /* ->orWhere('nombres', 'like', '%' . $search . '%'); */
      });
    });
  }

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
