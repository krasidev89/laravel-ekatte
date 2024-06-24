<?php

namespace App\Repositories\Panel;

use App\Exports\Panel\DistrictsExport;
use App\Models\District;
use App\Repositories\Repository;
use Maatwebsite\Excel\Facades\Excel;

class DistrictRepository extends Repository
{
    protected $model;

    public function __construct(District $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $districts = $this->model->with([
            'region',
            'municipalities'
        ])->select('districts.*');

        $datatable = datatables()->eloquent($districts);

        $datatable->addColumn('actions', function ($district) {
            return view('panel.districts.table.table-actions', compact('district'));
        });

        return $datatable->make(true);
    }

    public function delete($id)
    {
        $district = $this->model->findOrFail($id);

        if ($district->municipalities->isEmpty()) {
            return $district->delete();
        }
    }

    public function export($data)
    {
        return Excel::download(new DistrictsExport, 'districts-' . time() . '.xlsx');
    }
}
