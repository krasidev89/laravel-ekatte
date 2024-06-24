<?php

namespace App\Repositories\Panel;

use App\Exports\Panel\TownHallsExport;
use App\Models\TownHall;
use App\Repositories\Repository;
use Maatwebsite\Excel\Facades\Excel;

class TownHallRepository extends Repository
{
    protected $model;

    public function __construct(TownHall $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $townHalls = $this->model->with([
            'municipality',
            'settlements'
        ])->select('town_halls.*');

        $datatable = datatables()->eloquent($townHalls);

        $datatable->addColumn('actions', function ($town_hall) {
            return view('panel.town-halls.table.table-actions', compact('town_hall'));
        });

        return $datatable->make(true);
    }

    public function delete($id)
    {
        $townHall = $this->model->findOrFail($id);

        if ($townHall->settlements->isEmpty()) {
            return $townHall->delete();
        }
    }

    public function export($data)
    {
        return Excel::download(new TownHallsExport, 'town-halls-' . time() . '.xlsx');
    }

    public function getAllByMunicipalityID($id)
    {
        return $this->model->where('municipality_id', $id)->get();
    }
}
