<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedade extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';

    protected $fillable = [
        'nombre_enfermedades',
        'tratamientos',
        'alimentacion',
        'recomendaciones',
    ];

    public function historiales()
    {
        return $this->hasMany(Historiale::class);
    }
}
