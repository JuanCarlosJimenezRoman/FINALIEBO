<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
use Illuminate\Support\Facades\Gate;

    Gate::define('is-admin', function ($user) {
        return $user->role === 'admin'; // Ajusta el campo de rol según tu base de datos
    });

    // Gate para clientes
    Gate::define('is-client', function ($user) {
        return $user->role === 'cliente'; // Ajusta el campo de rol según tu base de datos
    });
