<?php

namespace App\Repositories\Panel;

use App\Models\Region;
use App\Repositories\Repository;

class RegionRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Region  $model
     * @return void
     */
    public function __construct(Region $model)
    {
        $this->model = $model;
    }

    /**
     * Get regions for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRegionsForDataTable(array $data)
    {
        return $this->model->with('districts')->select('regions.*');
    }
}
