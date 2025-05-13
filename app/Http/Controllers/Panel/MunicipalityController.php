<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Municipality\StoreMunicipalityRequest;
use App\Http\Requests\Panel\Municipality\UpdateMunicipalityRequest;
use App\Services\Panel\MunicipalityService;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    protected $municipalityService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\MunicipalityService  $municipalityService
     * @return void
     */
    public function __construct(MunicipalityService $municipalityService)
    {
        $this->municipalityService = $municipalityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->municipalityService->authorizeViewAny();

        if ($request->ajax()) {
            $municipalities = $this->municipalityService->getMunicipalitiesForDataTable($request->all());

            $datatable = datatables()->eloquent($municipalities);

            $datatable->addColumn('actions', function ($municipality) {
                return view('panel.municipalities.table.table-actions', compact('municipality'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.municipalities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->municipalityService->authorizeCreate();

        $districts = $this->municipalityService->getAllDistricts();

        return view('panel.municipalities.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Municipality\StoreMunicipalityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMunicipalityRequest $request)
    {
        $this->municipalityService->authorizeCreate();

        $this->municipalityService->create($request->only(['code', 'ekatte', 'name', 'district_id']));

        return redirect()->route('panel.municipalities.index')
            ->withSuccess(__('Municipality added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->municipalityService->authorizeUpdate($id);

        $data = $this->municipalityService->getEditData($id);

        return view('panel.municipalities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Municipality\UpdateMunicipalityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMunicipalityRequest $request, $id)
    {
        $this->municipalityService->authorizeUpdate($id);

        $this->municipalityService->update($request->only(['code', 'ekatte', 'name', 'district_id']), $id);

        return redirect()->route('panel.municipalities.index')
            ->withSuccess(__('Municipality updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->municipalityService->authorizeDelete($id);

        return $this->municipalityService->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->municipalityService->authorizeViewAny();

        return $this->municipalityService->export($request->all());
    }
}
