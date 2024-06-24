<?php

namespace App\Repositories\Panel;

use App\Exports\Panel\RegionsExport;
use App\Models\Region;
use App\Repositories\Repository;
use Maatwebsite\Excel\Facades\Excel;

class RegionRepository extends Repository
{
    protected $model;

    public function __construct(Region $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $regions = $this->model->with('districts')
            ->select('regions.*');

        $datatable = datatables()->eloquent($regions);

        $datatable->addColumn('actions', function ($region) {
            return view('panel.regions.table.table-actions', compact('region'));
        });

        return $datatable->make(true);
    }

    public function delete($id)
    {
        $region = $this->model->findOrFail($id);

        if ($region->districts->isEmpty()) {
            return $region->delete();
        }
    }

    public function export($data)
    {
        return Excel::download(new RegionsExport, 'regions-' . time() . '.xlsx');
    }
}
