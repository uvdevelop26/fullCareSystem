<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioRutina extends Model
{

    use HasFactory;

    protected $table = 'horario_rutina';

    protected $fillable = [
        'hora'
    ];

    //muchos a muchos
    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class);
    }
}
