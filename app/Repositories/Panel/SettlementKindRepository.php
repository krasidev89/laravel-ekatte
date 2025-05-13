<?php

namespace App\Repositories\Panel;

use App\Models\SettlementKind;
use App\Repositories\Repository;

class SettlementKindRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\SettlementKind  $model
     * @return void
     */
    public function __construct(SettlementKind $model)
    {
        $this->model = $model;
    }
}
