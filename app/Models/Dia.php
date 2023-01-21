<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    use HasFactory;

    protected $table = 'dias';

    //relacion de muchos a muchos

    public function turnos()
    {
        return $this->belongsToMany(Turno::class);
    }
}
