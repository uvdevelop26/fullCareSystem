<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoResidente extends Model
{
    use HasFactory;

    protected $table = 'estado_residentes';

    protected $fillable = ['nombre_estado'];

    //relación de uno a muchos con residentes
    public function residentes()
    {
        return $this->hasMany(Residente::class);
    }
}
