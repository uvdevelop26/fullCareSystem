<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familiare extends Model
{

    use HasFactory;

    protected $table = 'familiares';

    //relacion uno a muchos
    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function residente()
    {
        return $this->belongsTo(Residente::class);
    }
}
