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
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        Route::resource('settlements', SettlementController::class)->except(['show', 'restore', 'forceDelete']);

        // Town-halls
        Route::get('town-halls/export', [TownHallController::class, 'export'])->name('town-halls.export');
        Route::resource('town-halls', TownHallController::class)->except(['show', 'restore', 'forceDelete']);

        // Municipalities
        Route::get('municipalities/export', [MunicipalityController::class, 'export'])->name('municipalities.export');
        Route::resource('municipalities', MunicipalityController::class)->except(['show', 'restore', 'forceDelete']);

        // Districts
        Route::get('districts/export', [DistrictController::class, 'export'])->name('districts.export');
        Route::resource('districts', DistrictController::class)->except(['show', 'restore', 'forceDelete']);

        // Regions
        Route::get('regions/export', [RegionController::class, 'export'])->name('regions.export');
        Route::resource('regions', RegionController::class)->except(['show', 'restore', 'forceDelete']);

        // Activity Logs
        Route::resource('activity-logs', ActivityLogController::class)->only(['index', 'show']);

        // Users
        Route::resource('users', UserController::class)->except('show');

        // Roles
        Route::resource('roles', RoleController::class)->except(['show', 'restore', 'forceDelete']);

        // Permissions
        Route::resource('permissions', PermissionController::class)->only(['index', 'edit', 'update']);
    });
});
