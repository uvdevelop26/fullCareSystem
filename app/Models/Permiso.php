<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';

    protected $fillable =  [
        'fecha_inicio',
        'fecha_fin',
        'duracion',
        'motivo',
        'empleado_id',
        'estado_variacione_id'
    ];

    //Mutadores y Accesores
    

    //funciones de relación

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function estadoVariacione()
    {
        return $this->belongsTo(EstadoVariacione::class);
    }

     //Mutadores y Accesores
     protected function motivo(): Attribute
     {
         return new Attribute(
             get: fn($value) => ucwords($value),
             set: fn($value) => strtolower($value)
         );
 
     }

    //SCOPE PARA BUSQUEDA
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('empleado.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%')
                        ->orWhere('apellidos', 'like', '%' . $search . '%')
                        ->orWhere('ci_numero', 'like', '%' . $search . '%');
                });
            });
        })->when($filters['search_estado'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('estadoVariacione', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        });
    }
}
