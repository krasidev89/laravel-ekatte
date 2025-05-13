<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Settlement\StoreSettlementRequest;
use App\Http\Requests\Panel\Settlement\UpdateSettlementRequest;
use App\Services\Panel\SettlementService;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    protected $settlementService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\SettlementService  $settlementService
     * @return void
     */
    public function __construct(SettlementService $settlementService)
    {
        $this->settlementService = $settlementService;
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
            $settlements = $this->settlementService->getSettlementsForDataTable($request->all());

            $datatable = datatables()->eloquent($settlements);

            $datatable->addColumn('actions', function ($settlement) {
                return view('panel.settlements.table.table-actions', compact('settlement'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        $districts = $this->settlementService->getAllDistricts();

        return view('panel.settlements.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->settlementService->authorizeCreate();

        $data = $this->settlementService->getCreateData();

        return view('panel.settlements.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Settlement\StoreSettlementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettlementRequest $request)
    {
        $this->settlementService->authorizeCreate();

        $this->settlementService->create($request->only(['ekatte', 'name', 'settlement_kind_id', 'town_hall_id']));

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
        $this->settlementService->authorizeUpdate($id);

        $data = $this->settlementService->getEditData($id);

        return view('panel.settlements.edit', $data);
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
        $this->settlementService->authorizeUpdate($id);

        $this->settlementService->update($request->only(['ekatte', 'name', 'settlement_kind_id', 'town_hall_id']), $id);

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
        $this->settlementService->authorizeDelete($id);

        return $this->settlementService->delete($id);
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
            return $this->settlementService->getAllMunicipalitiesByDistrictID($request->get('district_id'));
        }

        return $this->settlementService->getAllMunicipalities();
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
            return $this->settlementService->getAllTownHallsByMunicipalityID($request->get('municipality_id'));
        }

        return $this->settlementService->getAllTownHalls();
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->settlementService->export($request->all());
    }
}
