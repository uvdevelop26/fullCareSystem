<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'fecha_inicio',
        'email',
        'seccion_id',
        'persona_id'
    ];

    //Mutadores y Accesores
    

    //relacion de uno a muchos
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function sueldos()
    {
        return $this->hasMany(Sueldo::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function permisos()
    {
        return $this->hasMany(Permiso::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jornadas()
    {
        return $this->hasMany(Jornada::class);
    }
    public function vacaciones()
    {
        return $this->hasMany(Vacacione::class);
    }


    //SCOPE PARA BÚSQUEDAS
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
        })->when($filters['search_seccion'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('seccion', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        });
    }
}
