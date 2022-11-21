<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    //Relación uno a muchos
    public function personas()
    {
        return $this->hasMany('App\Models\Persona');
    }
}
