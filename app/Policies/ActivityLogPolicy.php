<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ActivityLogPolicy
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
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.activity-logs.index');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ActivityLog $activityLog): bool
    {
        return $user->hasRole('admin') || $user->hasPermissionTo('panel.activity-logs.show');
    }

    /**
     * Determine whether the user can create models
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ActivityLog $activityLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ActivityLog $activityLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ActivityLog $activityLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ActivityLog  $activityLog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ActivityLog $activityLog): bool
    {
        return false;
    }
}
