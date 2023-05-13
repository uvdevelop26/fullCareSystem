<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';

    protected $fillable = [
        'turno',
        'empleado_id',
        'hora_entrada',
        'hora_salida'
    ];



    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    //relacion muchos a muchos
    public function dias()
    {
        return $this->belongsToMany(Dia::class);
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
        })->when($filters['search_turno'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nombre_turnos', $search);
            });
        });
    }
}
