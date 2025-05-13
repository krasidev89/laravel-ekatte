<?php

namespace App\Services\Panel;

use App\Exports\Panel\RegionsExport;
use App\Repositories\Panel\RegionRepository;
use App\Services\Service;
use App\Traits\Authorizable;
use Maatwebsite\Excel\Facades\Excel;

class RegionService extends Service
{
    use Authorizable;

    protected $repository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\RegionRepository  $regionRepository
     * @return void
     */
    public function __construct(RegionRepository $regionRepository)
    {
        $this->repository = $regionRepository;
    }

    /**
     * Get regions for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRegionsForDataTable(array $data)
    {
        return $this->repository->getRegionsForDataTable($data);
    }

    /**
     * Export region data to Excel.
     *
     * @param  array  $data
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(array $data)
    {
        return Excel::download(new RegionsExport, 'regions-' . time() . '.xlsx');
    }
}
