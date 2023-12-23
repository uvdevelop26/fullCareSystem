<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EstadoResidente extends Model
{
    use HasFactory;

    protected $table = 'estado_residentes';

    protected $fillable = [
        'nombre',
        'motivo_salida',
        'fecha_salida',
        'fecha_regreso',
        'residente_id'
    ];

    //relación de uno a muchos con residentes

    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    //SCOPE PARA LAS BÚSQUEDAS
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%')
                        ->orWhere('apellidos', 'like', '%' . $search . '%')
                        ->orWhere('ci_numero', 'like', '%' . $search . '%');
                });
            });
        })->when($filters['search_estado'] ?? null, function ($query, $search) {

            $query->where(function ($query) use ($search) {

                if ($search == 1) {
                    $query->where('nombre', $search);
                } else {
                    $variable = ($search == 2) ? boolval(false) : null;
                    $query->where('nombre', $variable);
                }

            });
        });
    }
}
