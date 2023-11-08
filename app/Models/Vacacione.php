<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Vacacione extends Model
{
    use HasFactory;

    protected $table = 'vacaciones';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'duracion',
        'observacion',
        'empleado_id',
        'estado_variacione_id',
    ];

    //relaciones de uno a muchos
    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function estadoVariacione()
    {
        return $this->belongsTo(EstadoVariacione::class);
    }

     //Mutadores y Accesores
     protected function observacion(): Attribute
     {
         return new Attribute(
             get: fn($value) => ucwords($value),
             set: fn($value) => strtolower($value)
         );
 
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
                $query->whereHas('estadoVariacione', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        });
    }
}
