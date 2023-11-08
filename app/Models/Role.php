<?php

namespace App\Models;

use Spatie\Permission\Models\Role as OriginalRole;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Role extends OriginalRole
{

    public $guard_name = 'web';

    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at',
    ];

    //Mutadores y Accesores
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );

    }


    //SCOPE PARA BÚSQUEDAS
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('id', $search);
            });
        });
    }
}
