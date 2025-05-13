<?php

namespace App\Policies;

use App\Models\Municipality;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MunicipalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.municipalities.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Municipality $municipality): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.municipalities.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Municipality $municipality): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.municipalities.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Municipality $municipality): bool
    {
        return ($user->hasRole('admin') || $user->hasPermissionTo('panel.municipalities.destroy')) && $municipality->townHalls->isEmpty();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Municipality $municipality): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Municipality  $municipality
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Municipality $municipality): bool
    {
        return false;
    }
}
