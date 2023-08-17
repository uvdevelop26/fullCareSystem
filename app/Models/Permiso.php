<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function estadoVariacione()
    {
        return $this->belongsTo(EstadoVariacione::class);
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
