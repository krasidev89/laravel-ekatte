<?php

namespace App\Providers;

use App\Models\ActivityLog;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Permission;
use App\Models\Region;
use App\Models\Role;
use App\Models\Settlement;
use App\Models\TownHall;
use App\Models\User;
use App\Policies\ActivityLogPolicy;
use App\Policies\DistrictPolicy;
use App\Policies\MunicipalityPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RegionPolicy;
use App\Policies\RolePolicy;
use App\Policies\SettlementPolicy;
use App\Policies\TownHallPolicy;
use App\Policies\UserPolicy;
use App\Routing\ResourceRegistrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    use \Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Register all model policies.
     */
    public function registerPolicies(): void
    {
        Gate::policy(Settlement::class, SettlementPolicy::class);
        Gate::policy(TownHall::class, TownHallPolicy::class);
        Gate::policy(Municipality::class, MunicipalityPolicy::class);
        Gate::policy(District::class, DistrictPolicy::class);
        Gate::policy(Region::class, RegionPolicy::class);
        Gate::policy(ActivityLog::class, ActivityLogPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RouteServiceProvider::loadCachedRoutesUsing(fn() => $this->loadCachedRoutes());

        Password::defaults(function () {
            return Password::min(6);
        });

        $this->registerPolicies();

        $this->app->bind(BaseResourceRegistrar::class, ResourceRegistrar::class);
    }
}
