<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlRutina extends Model
{
    use HasFactory;

    protected $table = 'control_rutina';

    protected $fillable = [
        'fecha',
        'hora',
        'realizado',
        'user_id',
        'horario_rutina_id'
    ];

    //uno a muchos con users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
