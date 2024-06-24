<?php

namespace App\Providers;

use App\Routing\ResourceRegistrar;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(BaseResourceRegistrar::class, ResourceRegistrar::class);

        Password::defaults(function () {
            return Password::min(6);
        });
    }
}
