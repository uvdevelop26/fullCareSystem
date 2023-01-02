<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudade extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    
    //relacion de uno a muchos
    public function personas(){
        return $this->hasMany(Persona::class);
    }
}
