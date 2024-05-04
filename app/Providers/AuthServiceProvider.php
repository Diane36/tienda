<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Tienda;
use App\Models\User;
use App\Policies\TiendaPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tienda::class => TiendaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('editar-tienda', function (User $user, Tienda $tienda) {
            return $user->id === $tienda->user_id
            ? Response::allow()
            : Response::deny('No puedes editar este libro');
        });

        Gate::define('delete', function ($user, $tienda) {
            return $user->id === $tienda->user_id;
        });
    }
}
