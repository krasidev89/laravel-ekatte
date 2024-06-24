<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Settlement\StoreSettlementRequest;
use App\Http\Requests\Panel\Settlement\UpdateSettlementRequest;
use App\Repositories\Panel\DistrictRepository;
use App\Repositories\Panel\MunicipalityRepository;
use App\Repositories\Panel\SettlementKindRepository;
use App\Repositories\Panel\SettlementRepository;
use App\Repositories\Panel\TownHallRepository;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    private $settlementKindRepository;
    private $settlementRepository;
    private $districtRepository;
    private $municipalityRepository;
    private $townHallRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\SettlementKindRepository  $settlementKindRepository
     * @param  \App\Repositories\Panel\SettlementRepository  $settlementRepository
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @param  \App\Repositories\Panel\TownHallRepository  $townHallRepository
     * @return void
     */
    public function __construct(
        SettlementKindRepository $settlementKindRepository,
        SettlementRepository $settlementRepository,
        DistrictRepository $districtRepository,
        MunicipalityRepository $municipalityRepository,
        TownHallRepository $townHallRepository
    ) {
        $this->settlementKindRepository = $settlementKindRepository;
        $this->settlementRepository = $settlementRepository;
        $this->districtRepository = $districtRepository;
        $this->municipalityRepository = $municipalityRepository;
        $this->townHallRepository = $townHallRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->settlementRepository->data($request->all());
        }

        $districts = $this->districtRepository->all();

        return view('panel.settlements.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settlementKinds = $this->settlementKindRepository->all();
        $districts = $this->districtRepository->all();
        $municipalities = $this->municipalityRepository->getAllByDistrictID(session()->getOldInput('district_id'));
        $townHalls = $this->townHallRepository->getAllByMunicipalityID(session()->getOldInput('municipality_id'));

        return view('panel.settlements.create', compact('settlementKinds', 'districts', 'municipalities', 'townHalls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Settlement\StoreSettlementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettlementRequest $request)
    {
        $this->settlementRepository->create($request->only(['ekatte', 'name', 'settlement_kind_id', 'town_hall_id']));

        return redirect()->route('panel.settlements.index')
            ->withSuccess(__('Settlement added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settlementKinds = $this->settlementKindRepository->all();
        $settlement = $this->settlementRepository->show($id);
        $districts = $this->districtRepository->all();
        $municipalities = $this->municipalityRepository->getAllByDistrictID(session()->getOldInput('district_id', $settlement->district_id));
        $townHalls = $this->townHallRepository->getAllByMunicipalityID(session()->getOldInput('municipality_id', $settlement->municipality_id));

        return view('panel.settlements.edit', compact('settlementKinds', 'settlement', 'districts', 'municipalities', 'townHalls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Settlement\UpdateSettlementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettlementRequest $request, $id)
    {
        $this->settlementRepository->update($request->only(['ekatte', 'name', 'settlement_kind_id', 'town_hall_id']), $id);

        return redirect()->route('panel.settlements.index')
            ->withSuccess(__('Settlement updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->settlementRepository->delete($id);
    }

    /**
     *  Municipalities data results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataMunicipalities(Request $request)
    {
        if ($request->has('district_id')) {
            return $this->municipalityRepository->getAllByDistrictID($request->get('district_id'));
        }

        return $this->municipalityRepository->all();
    }

    /**
     *  Town Halls data results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTownHalls(Request $request)
    {
        if ($request->has('municipality_id')) {
            return $this->townHallRepository->getAllByMunicipalityID($request->get('municipality_id'));
        }

        return $this->townHallRepository->all();
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->settlementRepository->export($request->all());
    }
}
