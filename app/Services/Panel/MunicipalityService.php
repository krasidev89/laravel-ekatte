<?php

namespace App\Services\Panel;

use App\Exports\Panel\MunicipalitiesExport;
use App\Repositories\Panel\MunicipalityRepository;
use App\Repositories\Panel\DistrictRepository;
use App\Services\Service;
use App\Traits\Authorizable;
use Maatwebsite\Excel\Facades\Excel;

class MunicipalityService extends Service
{
    use Authorizable;

    protected $repository;
    protected $districtRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @return void
     */
    public function __construct(MunicipalityRepository $municipalityRepository, DistrictRepository $districtRepository)
    {
        $this->repository = $municipalityRepository;
        $this->districtRepository = $districtRepository;
    }

    /**
     * Get municipalities for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getMunicipalitiesForDataTable(array $data)
    {
        return $this->repository->getMunicipalitiesForDataTable($data);
    }

    /**
     * Get all districts.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllDistricts()
    {
        return $this->districtRepository->all();
    }

    /**
     * Get edit data for a specific municipality.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $municipality = $this->repository->findOrFail($id);
        $districts = $this->getAllDistricts();

        return compact('municipality', 'districts');
    }

    /**
     * Export municipalities data to Excel.
     *
     * @param  array  $data
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(array $data)
    {
        return Excel::download(new MunicipalitiesExport, 'municipalities-' . time() . '.xlsx');
    }
}
