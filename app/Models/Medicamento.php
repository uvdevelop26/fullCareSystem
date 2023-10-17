<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'dosis',
        'indicaciones',
        'efectos_secundarios',
        'residente_id',
        'presentacione_id'
    ];


    //Relación de uno a muchos
    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    public function presentacione()
    {
        return $this->belongsTo(Presentacione::class);
    }

    //relación de muchos a muchos

    public function horarioMedicamentos()
    {
        return $this->belongsToMany(horarioMedicamento::class);
    }

      //SCOPE PARA BUSQUEDA
      public function scopeFilter($query, array $filters)
      {
          $query->when($filters['search_residente'] ?? null, function ($query, $search) {
              $query->where(function ($query) use ($search) {
                  $query->whereHas('residente.persona', function ($query) use ($search) {
                      $query->where('nombres', 'like', '%' . $search . '%')
                          ->orWhere('apellidos', 'like', '%' . $search . '%')
                          ->orWhere('ci_numero', 'like', '%' . $search . '%');
                  });
              });
          })->when($filters['search_nombre'] ?? null, function ($query, $search) {
              $query->where(function ($query) use ($search) {
                $query->where('nombre', 'like', '%' . $search . '%');
              });
          });
      }
}
