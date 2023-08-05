<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;

    protected $table = 'dias';

    protected $fillable = [
        'nombre_dias'
    ];

    //relacion de muchos a muchos
    public function jornadas()
    {
        return $this->belongsToMany(Jornada::class);
    }
}
