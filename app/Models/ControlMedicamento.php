<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlMedicamento extends Model
{
    use HasFactory;

    protected $table = 'control_medicamento';

    protected $fillable = [
        'fecha',
        'hora',
        'realizado',
        'user_id',
        'horario_medicamento_id'
    ];

    //uno a muchos con users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarioMedicamento()
    {
        return $this->belongsTo(HorarioMedicamento::class);
    }

     //SCOPE PARA BÚSQUEDAS
     public function scopeFilter($query, array $filters)
     {
         $query->when($filters['search_residente'] ?? null, function ($query, $search) {
             $query->where(function ($query) use ($search) {
                 $query->whereHas('horarioMedicamento.medicamentos.residente.persona', function ($query) use ($search) {
                     $query->where('nombres', 'like', '%' . $search . '%');
                 });
             });
         });
     }
}
