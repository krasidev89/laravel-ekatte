<?php

namespace App\Repositories\Panel;

use App\Models\Settlement;
use App\Repositories\Repository;

class SettlementRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Settlement  $model
     * @return void
     */
    public function __construct(Settlement $model)
    {
        $this->model = $model;
    }

    /**
     * Get settlements for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getSettlementsForDataTable(array $data)
    {
        $settlements = $this->model->with([
            'settlement_kind',
            'town_hall',
            'municipality',
            'district'
        ])->select('settlements.*');

        if ($data['town_hall_id']) {
            $settlements->where('town_hall_id', $data['town_hall_id']);
        }

        if ($data['municipality_id']) {
            $settlements->where('municipality_id', $data['municipality_id']);
        }

        if ($data['district_id']) {
            $settlements->where('district_id', $data['district_id']);
        }

        return $settlements;
    }

    /**
     * Show a specific settlement by ID.
     *
     * @param  int  $id
     * @return \App\Models\Settlement
     */
    public function show($id)
    {
        return $this->model->with('settlement_kind')->findOrFail($id);
    }
}
