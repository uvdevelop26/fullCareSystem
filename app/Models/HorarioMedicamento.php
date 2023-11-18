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
}
