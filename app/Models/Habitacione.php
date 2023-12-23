<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacione extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'numero',
        'descripcion'
    ];


    //funciones de relación
    public function residentes()
    {
        return $this->hasMany(Residente::class);
    }
}
