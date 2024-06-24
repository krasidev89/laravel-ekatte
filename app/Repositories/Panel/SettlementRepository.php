<?php

namespace App\Repositories\Panel;

use App\Exports\Panel\SettlementsExport;
use App\Models\Settlement;
use App\Models\TownHall;
use App\Repositories\Repository;
use Maatwebsite\Excel\Facades\Excel;

class SettlementRepository extends Repository
{
    protected $model;

    public function __construct(Settlement $model)
    {
        $this->model = $model;
    }

    public function data($data)
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

        $datatable = datatables()->eloquent($settlements);

        $datatable->addColumn('actions', function ($settlement) {
            return view('panel.settlements.table.table-actions', compact('settlement'));
        });

        return $datatable->make(true);
    }

    public function create(array $data)
    {
        if ($townHall = TownHall::findOrFail($data['town_hall_id'])) {
            $data['municipality_id'] = $townHall->municipality_id;
            $data['district_id'] = $townHall->municipality->district_id;

            return $this->model->create($data);
        }
    }

    public function show($id)
    {
        return $this->model->with('settlement_kind')->findOrFail($id);
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        $settlement = $this->model->findOrFail($id);

        if ($townHall = TownHall::find($data['town_hall_id'])) {
            $data['municipality_id'] = $townHall->municipality_id;
            $data['district_id'] = $townHall->municipality->district_id;
        }

        $settlement->update($data);

        return $settlement;
    }

    public function export($data)
    {
        return Excel::download(new SettlementsExport, 'settlements-' . time() . '.xlsx');
    }
}
