<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
   
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    
    public function boot()
    {

        $this->registerPolicies();

        // Conceder implicitamente todos los permisos a"Super-Admin" usando can()
        Gate::before(function ($user, $ability) {
            if ($user->hasRole(env('APP_SUPER_ADMIN', 'super-admin'))) {
                return true;
            }
        });
    }
}
