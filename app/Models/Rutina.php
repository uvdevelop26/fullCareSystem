<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use HasFactory;

    protected $table = 'rutinas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'residente_id',
    ];

    //relación de uno a muchos
    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }

    //relación de muchos a muchos
   /*  public function horarios()
    {
        return $this->belongsToMany(Horario::class);
    } */
}
