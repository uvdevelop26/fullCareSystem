<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;
    
    protected $table = 'caracteristicas';

    protected $fillable = [
        'peso',
        'altura',
        'temperatura',
        'presion_arterial',
    ];

    public function historiales()
    {
        return $this->hasMany(Historiale::class);
    }
}
