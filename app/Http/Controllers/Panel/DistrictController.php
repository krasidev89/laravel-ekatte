<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\District\StoreDistrictRequest;
use App\Http\Requests\Panel\District\UpdateDistrictRequest;
use App\Services\Panel\DistrictService;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    protected $districtService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\DistrictService  $districtService
     * @return void
     */
    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->districtService->authorizeViewAny();

        if ($request->ajax()) {
            $districts = $this->districtService->getDistrictsForDataTable($request->all());

            $datatable = datatables()->eloquent($districts);

            $datatable->addColumn('actions', function ($district) {
                return view('panel.districts.table.table-actions', compact('district'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.districts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->districtService->authorizeCreate();

        $regions = $this->districtService->getAllRegions();

        return view('panel.districts.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\District\StoreDistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrictRequest $request)
    {
        $this->districtService->authorizeCreate();

        $this->districtService->create($request->only(['code', 'ekatte', 'name', 'region_id']));

        return redirect()->route('panel.districts.index')
            ->withSuccess(__('District added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->districtService->authorizeUpdate($id);

        $data = $this->districtService->getEditData($id);

        return view('panel.districts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\District\UpdateDistrictRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistrictRequest $request, $id)
    {
        $this->districtService->authorizeUpdate($id);

        $this->districtService->update($request->only(['code', 'ekatte', 'name', 'region_id']), $id);

        return redirect()->route('panel.districts.index')
            ->withSuccess(__('District updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->districtService->authorizeDelete($id);

        return $this->districtService->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->districtService->authorizeViewAny();

        return $this->districtService->export($request->all());
    }
}
