<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre_medicamento',
        'via_suministro',
        'fecha_vencimiento',
        'dosis_cantidad',
        'stock',
        'residente_id'
    ];


    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    public function horarios()
    {
        return $this->belongsToMany(Horario::class);
    }
}
