<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    use HasFactory;

    protected  $table = 'alergias';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function historiales()
    {
        return $this->belongsToMany(Historiale::class);
    }
}
