<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMedicamento extends Model
{
    use HasFactory;

    protected $table = 'horario_medicamento';

    protected $fillable = ['hora'];


    //relación de muchos a muchos
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class);
    }

    public function controlMedicamentos()
    {
        return $this->hasMany(ControlMedicamento::class);
    }

    //SCOPE PARA BÚSQUEDAS
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search_residente'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('medicamentos.residente.persona', function ($query) use ($search) {
                    $query->where('nombres', 'like', '%' . $search . '%');
                });
            });
        });
    }
}
