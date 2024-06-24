<?php

use App\Http\Controllers\Panel\ActivityLogController;
use App\Http\Controllers\Panel\DistrictController;
use App\Http\Controllers\Panel\MunicipalityController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\ProfileController;
use App\Http\Controllers\Panel\RegionController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\SettlementController;
use App\Http\Controllers\Panel\TownHallController;
use App\Http\Controllers\Panel\UserController;
use Illuminate\Support\Facades\Route;

// Localization prefix
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Auth forms
    Auth::routes();

    // Guest users
    Route::view('/', 'auth.login')->middleware('guest');

    // Auth users
    Route::group([
        'prefix' => 'panel',
        'as' => 'panel.',
        'middleware' => 'auth'
    ], function () {
        // Profile
        Route::singleton('profile', ProfileController::class)->except('edit')->destroyable();

        // Settlements
        Route::get('settlements/data-municipalities', [SettlementController::class, 'dataMunicipalities'])->name('settlements.data-municipalities');
        Route::get('settlements/data-town-halls', [SettlementController::class, 'dataTownHalls'])->name('settlements.data-town-halls');
        Route::get('settlements/export', [SettlementController::class, 'export'])->name('settlements.export');
        Route::resource('settlements', SettlementController::class)->only('index');
        Route::resource('settlements', SettlementController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.settlements.create');
        Route::resource('settlements', SettlementController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.settlements.edit');
        Route::resource('settlements', SettlementController::class)->only('destroy')->middleware('role_or_permission:admin|panel.settlements.destroy');

        // Town-halls
        Route::get('town-halls/export', [TownHallController::class, 'export'])->name('town-halls.export')->middleware('role_or_permission:admin|panel.town-halls.index');
        Route::resource('town-halls', TownHallController::class)->only('index')->middleware('role_or_permission:admin|panel.town-halls.index');
        Route::resource('town-halls', TownHallController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.town-halls.create');
        Route::resource('town-halls', TownHallController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.town-halls.edit');
        Route::resource('town-halls', TownHallController::class)->only('destroy')->middleware('role_or_permission:admin|panel.town-halls.destroy');

        // Municipalities
        Route::get('municipalities/export', [MunicipalityController::class, 'export'])->name('municipalities.export')->middleware('role_or_permission:admin|panel.municipalities.index');
        Route::resource('municipalities', MunicipalityController::class)->only('index')->middleware('role_or_permission:admin|panel.municipalities.index');
        Route::resource('municipalities', MunicipalityController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.municipalities.create');
        Route::resource('municipalities', MunicipalityController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.municipalities.edit');
        Route::resource('municipalities', MunicipalityController::class)->only('destroy')->middleware('role_or_permission:admin|panel.municipalities.destroy');

        // Districts
        Route::get('districts/export', [DistrictController::class, 'export'])->name('districts.export')->middleware('role_or_permission:admin|panel.districts.index');
        Route::resource('districts', DistrictController::class)->only('index')->middleware('role_or_permission:admin|panel.districts.index');
        Route::resource('districts', DistrictController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.districts.create');
        Route::resource('districts', DistrictController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.districts.edit');
        Route::resource('districts', DistrictController::class)->only('destroy')->middleware('role_or_permission:admin|panel.districts.destroy');

        // Regions
        Route::get('regions/export', [RegionController::class, 'export'])->name('regions.export')->middleware('role_or_permission:admin|panel.regions.index');
        Route::resource('regions', RegionController::class)->only('index')->middleware('role_or_permission:admin|panel.regions.index');
        Route::resource('regions', RegionController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.regions.create');
        Route::resource('regions', RegionController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.regions.edit');
        Route::resource('regions', RegionController::class)->only('destroy')->middleware('role_or_permission:admin|panel.regions.destroy');

        // Activity Logs
        Route::resource('activity-logs', ActivityLogController::class)->only('index')->middleware('role_or_permission:admin|panel.activity-logs.index');
        Route::resource('activity-logs', ActivityLogController::class)->only('show')->middleware('role_or_permission:admin|panel.activity-logs.show');

        // Users
        Route::resource('users', UserController::class)->only('index')->middleware('role_or_permission:admin|panel.users.index');
        Route::resource('users', UserController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.users.create');
        Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.users.edit');
        Route::resource('users', UserController::class)->only('destroy')->middleware('role_or_permission:admin|panel.users.destroy');
        Route::resource('users', UserController::class)->only('restore')->middleware('role_or_permission:admin|panel.users.restore');
        Route::resource('users', UserController::class)->only('forceDelete')->middleware('role_or_permission:admin|panel.users.force-delete');

        // Roles
        Route::resource('roles', RoleController::class)->only('index')->middleware('role_or_permission:admin|panel.roles.index');
        Route::resource('roles', RoleController::class)->only(['create', 'store'])->middleware('role_or_permission:admin|panel.roles.create');
        Route::resource('roles', RoleController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.roles.edit');
        Route::resource('roles', RoleController::class)->only('destroy')->middleware('role_or_permission:admin|panel.roles.destroy');

        // Permissions
        Route::resource('permissions', PermissionController::class)->only('index')->middleware('role_or_permission:admin|panel.permissions.index');
        Route::resource('permissions', PermissionController::class)->only(['edit', 'update'])->middleware('role_or_permission:admin|panel.permissions.edit');
    });
});
