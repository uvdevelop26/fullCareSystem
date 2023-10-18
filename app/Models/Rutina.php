<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutinas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'residente_id',
    ];

    //relación de uno a muchos
    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    //relación de muchos a muchos
    public function horarioRutinas()
    {
        return $this->belongsToMany(HorarioRutina::class);
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
