<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = ['hora'];


    //relación de muchos a muchos
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class);
    }

    public function rutinas()
    {
        return $this->belongsToMany(Rutina::class);
    }
}
