<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    //relacion muchos a muchos
    public function residentes()
    {
        return $this->belongsToMany('App\Models\Residente');
    }
}
