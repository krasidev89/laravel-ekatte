<?php

namespace App\Services\Panel;

use App\Exports\Panel\SettlementsExport;
use App\Repositories\Panel\DistrictRepository;
use App\Repositories\Panel\MunicipalityRepository;
use App\Repositories\Panel\SettlementKindRepository;
use App\Repositories\Panel\SettlementRepository;
use App\Repositories\Panel\TownHallRepository;
use App\Services\Service;
use App\Traits\Authorizable;
use Maatwebsite\Excel\Facades\Excel;

class SettlementService extends Service
{
    use Authorizable;

    protected $repository;
    protected $settlementKindRepository;
    protected $districtRepository;
    protected $municipalityRepository;
    protected $townHallRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\SettlementRepository  $settlementRepository
     * @param  \App\Repositories\Panel\SettlementKindRepository  $settlementKindRepository
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @param  \App\Repositories\Panel\TownHallRepository  $townHallRepository
     * @return void
     */
    public function __construct(
        SettlementRepository $settlementRepository,
        SettlementKindRepository $settlementKindRepository,
        DistrictRepository $districtRepository,
        MunicipalityRepository $municipalityRepository,
        TownHallRepository $townHallRepository
    ) {
        $this->repository = $settlementRepository;
        $this->settlementKindRepository = $settlementKindRepository;
        $this->districtRepository = $districtRepository;
        $this->municipalityRepository = $municipalityRepository;
        $this->townHallRepository = $townHallRepository;
    }

    /**
     * Get settlements for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getSettlementsForDataTable(array $data)
    {
        return $this->repository->getSettlementsForDataTable($data);
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
     * Get all municipalities by district ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMunicipalitiesByDistrictID($id)
    {
        return $this->municipalityRepository->getAllByDistrictID($id);
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
     * Get all town halls by municipality ID.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTownHallsByMunicipalityID($id)
    {
        return $this->townHallRepository->getAllByMunicipalityID($id);
    }

    /**
     * Get all town halls.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTownHalls()
    {
        return $this->townHallRepository->all();
    }

    /**
     * Get create data for a new settlement.
     *
     * @return array
     */
    public function getCreateData()
    {
        $settlementKinds = $this->settlementKindRepository->all();
        $districts = $this->getAllDistricts();
        $municipalities = $this->getAllMunicipalitiesByDistrictID(session()->getOldInput('district_id'));
        $townHalls = $this->getAllTownHallsByMunicipalityID(session()->getOldInput('municipality_id'));

        return compact('settlementKinds', 'districts', 'municipalities', 'townHalls');
    }

    /**
     * Create a new settlement.
     *
     * @param  array  $data
     * @return \App\Models\Settlement
     */
    public function create(array $data)
    {
        if ($townHall = $this->townHallRepository->findOrFail($data['town_hall_id'])) {
            $data['municipality_id'] = $townHall->municipality_id;
            $data['district_id'] = $townHall->municipality->district_id;

            return $this->repository->create($data);
        }
    }

    /**
     * Get edit data for a specific settlement.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $settlement = $this->repository->show($id);
        $settlementKinds = $this->settlementKindRepository->all();
        $districts = $this->getAllDistricts();
        $municipalities = $this->getAllMunicipalitiesByDistrictID(session()->getOldInput('district_id', $settlement->district_id));
        $townHalls = $this->getAllTownHallsByMunicipalityID(session()->getOldInput('municipality_id', $settlement->municipality_id));

        return compact('settlementKinds', 'settlement', 'districts', 'municipalities', 'townHalls');
    }

    /**
     * Update the specified settlement.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\Settlement
     */
    public function update(array $data, $id)
    {
        if ($townHall = $this->townHallRepository->find($data['town_hall_id'])) {
            $data['municipality_id'] = $townHall->municipality_id;
            $data['district_id'] = $townHall->municipality->district_id;

            return $this->repository->update($data, $id);
        }
    }

    /**
     * Export settlements data to Excel.
     *
     * @param  array  $data
     * @return \Maatwebsite\Excel\Facades\Excel
     */
    public function export(array $data)
    {
        return Excel::download(new SettlementsExport, 'settlements-' . time() . '.xlsx');
    }
}
