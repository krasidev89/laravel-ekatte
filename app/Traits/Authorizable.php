<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait Authorizable
{
    /**
     * Authorize view any action.
     */
    public function authorizeViewAny()
    {
        Gate::authorize('viewAny', $this->repository->getModelClass());
    }

    /**
     * Authorize view action.
     *
     * @param  int  $id
     */
    public function authorizeView($id)
    {
        Gate::authorize('view', $this->repository->findOrFail($id));
    }

    /**
     * Authorize create action.
     */
    public function authorizeCreate()
    {
        Gate::authorize('create', $this->repository->getModelClass());
    }

    /**
     * Authorize update action.
     *
     * @param  int  $id
     */
    public function authorizeUpdate($id)
    {
        Gate::authorize('update', $this->repository->findOrFail($id));
    }

    /**
     * Authorize delete action.
     *
     * @param  int  $id
     */
    public function authorizeDelete($id)
    {
        Gate::authorize('delete', $this->repository->findOrFail($id));
    }

    /**
     * Authorize restore action.
     *
     * @param  int  $id
     */
    public function authorizeRestore($id)
    {
        Gate::authorize('restore', $this->repository->withTrashed()->findOrFail($id));
    }

    /**
     * Authorize force delete action.
     *
     * @param  int  $id
     */
    public function authorizeForceDelete($id)
    {
        Gate::authorize('forceDelete', $this->repository->withTrashed()->findOrFail($id));
    }
}
