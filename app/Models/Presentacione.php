<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacione extends Model
{
    use HasFactory;

    protected $table = 'presentaciones';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function medicamentos()
    {
        return $this->hasMany(Medicamento::class);
    }
}
