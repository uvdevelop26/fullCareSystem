<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermedade extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function historiales()
    {
        return $this->belongsToMany(Historiale::class);
    }
}
