<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiar extends Model
{
    use HasFactory;

    //relación uno a uno inversa
    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }

    //relación uno a muchos inversa
    public function residente()
    {
        return $this->belongsTo('App\Models\Residente');
    }
}
