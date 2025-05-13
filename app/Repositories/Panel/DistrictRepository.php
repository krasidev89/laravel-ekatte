<?php

namespace App\Repositories\Panel;

use App\Models\District;
use App\Repositories\Repository;

class DistrictRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\District  $model
     * @return void
     */
    public function __construct(District $model)
    {
        $this->model = $model;
    }

    /**
     * Get districts for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getDistrictsForDataTable(array $data)
    {
        return $this->model->with([
            'region',
            'municipalities'
        ])->select('districts.*');
    }
}
