<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class HorarioRutina extends Model
{

    use HasFactory;

    protected $table = 'horario_rutina';

    protected $fillable = [
        'hora'
    ];

    //Mutadores y Accesores
    protected function hora(): Attribute
    {
        return new Attribute(
            get: fn ($value) => \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i')

        );
    }

    //muchos a muchos
    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class);
    }

    public function controlRutinas()
    {
        return $this->hasMany(ControlRutina::class);
    }

    //SCOPE PARA BÚSQUEDAS
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_residente'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('rutinas.residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%');
                });
            });
        });
    }
}
