<?php

namespace App\Repositories\Panel;

use App\Models\User;
use App\Repositories\Repository;

class ProfileRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\User  $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
