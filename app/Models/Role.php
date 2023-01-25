<?php

namespace App\Models;

use Spatie\Permission\Models\Role as OriginalRole;

class Role extends OriginalRole
{

    public $guard_name = 'web';  

    protected $fillable = [
        'name',
        'guard_name',
        'updated_at',
        'created_at',
    ];

}