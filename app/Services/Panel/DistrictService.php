<?php

namespace App\Services\Panel;

use App\Exports\Panel\DistrictsExport;
use App\Repositories\Panel\DistrictRepository;
use App\Repositories\Panel\RegionRepository;
use App\Services\Service;
use App\Traits\Authorizable;
use Maatwebsite\Excel\Facades\Excel;

class DistrictService extends Service
{
    use Authorizable;

    protected $repository;
    protected $regionRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @param  \App\Repositories\Panel\RegionRepository  $regionRepository
     * @return void
     */
    public function __construct(DistrictRepository $districtRepository, RegionRepository $regionRepository)
    {
        $this->repository = $districtRepository;
        $this->regionRepository = $regionRepository;
    }

    /**
     * Get districts for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getDistrictsForDataTable(array $data)
    {
        return $this->repository->getDistrictsForDataTable($data);
    }

    /**
     * Get all regions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRegions()
    {
        return $this->regionRepository->all();
    }

    /**
     * Get edit data for a specific district.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $district = $this->repository->findOrFail($id);
        $regions = $this->getAllRegions();

        return compact('district', 'regions');
    }

    /**
     * Export districts data to Excel.
     *
     * @param  array  $data
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(array $data)
    {
        return Excel::download(new DistrictsExport, 'districts-' . time() . '.xlsx');
    }
}
