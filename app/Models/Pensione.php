<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensione extends Model
{
    use HasFactory;

    //Relacion de muchos a muchos
    public function residentes()
    {
        return $this->belongsToMany('App\Models\Residente');
    }
}
