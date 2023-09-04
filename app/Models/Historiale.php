<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
