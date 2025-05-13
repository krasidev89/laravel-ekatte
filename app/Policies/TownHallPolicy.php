<?php

namespace App\Policies;

use App\Models\TownHall;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TownHallPolicy
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
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.town-halls.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TownHall  $townHall
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, TownHall $townHall): bool
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
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.town-halls.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TownHall  $townHall
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TownHall $townHall): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.town-halls.edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TownHall  $townHall
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TownHall $townHall): bool
    {
        return ($user->hasRole('admin') || $user->hasPermissionTo('panel.town-halls.destroy')) && $townHall->settlements->isEmpty();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TownHall  $townHall
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, TownHall $townHall): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TownHall  $townHall
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, TownHall $townHall): bool
    {
        return false;
    }
}
