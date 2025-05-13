<?php

namespace App\Repositories\Panel;

use App\Models\Municipality;
use App\Repositories\Repository;

class MunicipalityRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Municipality  $model
     * @return void
     */
    public function __construct(Municipality $model)
    {
        $this->model = $model;
    }

    /**
     * Get municipalities for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getMunicipalitiesForDataTable(array $data)
    {
        return $this->model->with([
            'district',
            'townHalls'
        ])->select('municipalities.*');
    }

    /**
     * Get all municipalities by district ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllByDistrictID($id)
    {
        return $this->model->where('district_id', $id)->get();
    }
}
