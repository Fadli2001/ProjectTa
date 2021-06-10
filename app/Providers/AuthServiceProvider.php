<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('users',function($user){           
                return  count(array_intersect(["ADMIN"],json_decode($user->role)));            
        });

        Gate::define('asnaf',function($user){           
            return  count(array_intersect(["ADMIN"],json_decode($user->role)));            
        });

        Gate::define('kategori_program',function($user){           
            return  count(array_intersect(["ADMIN"],json_decode($user->role)));            
        });

        Gate::define('proposal',function($user){
            return  count(array_intersect(["ADMIN","AMIL","PENGURUS","KETUA","BENDAHARA"],json_decode($user->role)));            
        });
    }
}
