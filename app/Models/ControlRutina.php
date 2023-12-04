<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlRutina extends Model
{
    use HasFactory;

    protected $table = 'control_rutina';

    protected $fillable = [
        'fecha',
        'hora',
        'realizado',
        'user_id',
        'horario_rutina_id'
    ];

    //uno a muchos con users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarioRutina()
    {
        return $this->belongsTo(HorarioRutina::class);
    }

    //SCOPE PARA BÚSQUEDAS
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_residente'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('horarioRutina.rutinas.residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%');
                });
            });
        })->when($filters['search_fecha'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereDate('fecha', $search);
            });
        });
    }
}
