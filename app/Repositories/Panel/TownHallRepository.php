<?php

namespace App\Repositories\Panel;

use App\Models\TownHall;
use App\Repositories\Repository;

class TownHallRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\TownHall  $model
     * @return void
     */
    public function __construct(TownHall $model)
    {
        $this->model = $model;
    }

    /**
     * Get town halls for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTownHallsForDataTable(array $data)
    {
        return $this->model->with([
            'municipality',
            'settlements'
        ])->select('town_halls.*');
    }

    /**
     * Get all town halls by a specific municipality ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllByMunicipalityID($id)
    {
        return $this->model->where('municipality_id', $id)->get();
    }
}
