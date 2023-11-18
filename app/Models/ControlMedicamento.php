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
}
