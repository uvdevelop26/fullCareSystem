<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'cirugias',
        'alergias',
        'recomendaciones',
    ];

    public function historiales()
    {
        return $this->hasMany(Historiale::class);
    }


}
