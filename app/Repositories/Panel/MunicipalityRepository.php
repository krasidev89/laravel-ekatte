<?php

namespace App\Repositories\Panel;

use App\Exports\Panel\MunicipalitiesExport;
use App\Models\Municipality;
use App\Repositories\Repository;
use Maatwebsite\Excel\Facades\Excel;

class MunicipalityRepository extends Repository
{
    protected $model;

    public function __construct(Municipality $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $municipalities = $this->model->with([
            'district',
            'townHalls'
        ])->select('municipalities.*');

        $datatable = datatables()->eloquent($municipalities);

        $datatable->addColumn('actions', function ($municipality) {
            return view('panel.municipalities.table.table-actions', compact('municipality'));
        });

        return $datatable->make(true);
    }

    public function delete($id)
    {
        $municipality = $this->model->findOrFail($id);

        if ($municipality->townHalls->isEmpty()) {
            return $municipality->delete();
        }
    }

    public function export($data)
    {
        return Excel::download(new MunicipalitiesExport, 'municipalities-' . time() . '.xlsx');
    }

    public function getAllByDistrictID($id)
    {
        return $this->model->where('district_id', $id)->get();
    }
}
