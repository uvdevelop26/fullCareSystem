<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    use HasFactory;

    public function personas()
    {
        return $this->hasMany('App\Models\Persona');
    }
}
