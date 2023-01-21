<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historiale extends Model
{
    use HasFactory;

    protected $table = 'historiales';

    protected $fillable = [
        'fecha_historial',
        'observaciones',
        'residente_id',
        'caracteristica_id',
        'enfermedade_id',
        'incidencia_id'
    ];

    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }

    public function enfermedade()
    {
        return $this->belongsTo(Enfermedade::class);
    }

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class);
    }
}
