<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Historiale extends Model
{
    use HasFactory;

    protected $table = 'historiales';

    protected $fillable = [
        'fecha_registro',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'residente_id',
        'caracteristica_id'
    ];


    //funciones de relación
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }

    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    public function enfermedades()
    {
        return $this->belongsToMany(Enfermedade::class);
    }

    public function alergias()
    {
        return $this->belongsToMany(Alergia::class);
    }

    //Mutadores y Accesores
    protected function diagnostico(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );

    }

    protected function tratamiento(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );

    }

    protected function observaciones(): Attribute
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
                $query->whereHas('residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%')
                        ->orWhere('apellidos', 'like', '%' . $search . '%')
                        ->orWhere('ci_numero', 'like', '%' . $search . '%');
                });
            });
        })->when($filters['search_anho'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereYear('fecha_registro', $search);
            });
        })->when($filters['search_mes'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereMonth('fecha_registro', $search);
            });
        });
    }
}
