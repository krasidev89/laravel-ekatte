<?php

namespace App\Repositories\Panel;

use App\Models\SettlementKind;
use App\Repositories\Repository;

class SettlementKindRepository extends Repository
{
    protected $model;

    public function __construct(SettlementKind $model)
    {
        $this->model = $model;
    }
}
