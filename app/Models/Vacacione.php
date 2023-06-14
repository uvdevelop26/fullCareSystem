<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacacione extends Model
{
    use HasFactory;

    protected $table = 'vacaciones';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'duracion',
        'estado',
        'observacion',
        'empleado_id'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }


    //SCOPE PARA LA BUSQUEDA
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
                $query->where('estado', $search);
            });
        });
    }
}
