<?php

namespace App\Services\Panel;

use App\Exports\Panel\TownHallsExport;
use App\Repositories\Panel\TownHallRepository;
use App\Repositories\Panel\MunicipalityRepository;
use App\Services\Service;
use App\Traits\Authorizable;
use Maatwebsite\Excel\Facades\Excel;

class TownHallService extends Service
{
    use Authorizable;

    protected $repository;
    protected $municipalityRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\TownHallRepository  $townHallRepository
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @return void
     */
    public function __construct(TownHallRepository $townHallRepository, MunicipalityRepository $municipalityRepository)
    {
        $this->repository = $townHallRepository;
        $this->municipalityRepository = $municipalityRepository;
    }

    /**
     * Get town halls for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTownHallsForDataTable(array $data)
    {
        return $this->repository->getTownHallsForDataTable($data);
    }

    /**
     * Get all municipalities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMunicipalities()
    {
        return $this->municipalityRepository->all();
    }

    /**
     * Get edit data for a specific town hall.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $townHall = $this->repository->findOrFail($id);
        $municipalities = $this->getAllMunicipalities();

        return compact('townHall', 'municipalities');
    }

    /**
     * Export town halls data to Excel.
     *
     * @param  array  $data
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(array $data)
    {
        return Excel::download(new TownHallsExport, 'town-halls-' . time() . '.xlsx');
    }
}
