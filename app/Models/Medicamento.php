<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'dosis',
        'indicaciones',
        'efectos_secundarios',
        'residente_id',
        'presentacione_id'
    ];


    //Relación de uno a muchos
    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    public function presentacione()
    {
        return $this->belongsTo(Presentacione::class);
    }

    //relación de muchos a muchos

    public function horarios()
    {
        return $this->belongsToMany(Horario::class);
    }
}
