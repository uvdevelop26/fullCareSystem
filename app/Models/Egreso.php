<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_egreso',
        'subtipo',
        'detalle',
        'fecha_egreso',
        'monto'
    ];
}
