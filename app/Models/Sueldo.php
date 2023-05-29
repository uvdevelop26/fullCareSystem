<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sueldo extends Model
{
    use HasFactory;

    protected $table = 'sueldos';

    protected $fillable = [
        'fecha',
        'monto',
        'empleado_id'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
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
        })->when($filters['search_seccion'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('empleado.seccion', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        })->when($filters['search_anho'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereYear('fecha', $search);
            });
        })->when($filters['search_mes'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereMonth('fecha', $search);
            });
        });
    }
}
