<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiare extends Model
{

    use HasFactory;

    protected $table = 'familiares';

    protected $fillable = [
        'parentezco',
        'email',
        'residente_id',
        'persona_id'
    ];

    //relacion uno a muchos
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    //SCOPE PARA BUSQUEDA
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
        })->when($filters['search_residente'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%');
                });
            });
        });
    }
}
