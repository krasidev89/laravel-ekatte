<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Region\StoreRegionRequest;
use App\Http\Requests\Panel\Region\UpdateRegionRequest;
use App\Services\Panel\RegionService;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    protected $regionService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\RegionService  $regionService
     * @return void
     */
    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->regionService->authorizeViewAny();

        if ($request->ajax()) {
            $regions = $this->regionService->getRegionsForDataTable($request->all());

            $datatable = datatables()->eloquent($regions);

            $datatable->addColumn('actions', function ($region) {
                return view('panel.regions.table.table-actions', compact('region'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.regions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->regionService->authorizeCreate();

        return view('panel.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Region\StoreRegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        $this->regionService->authorizeCreate();

        $this->regionService->create($request->only(['code', 'name']));

        return redirect()->route('panel.regions.index')
            ->withSuccess(__('Region added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->regionService->authorizeUpdate($id);

        $region = $this->regionService->findOrFail($id);

        return view('panel.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Region\UpdateRegionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        $this->regionService->authorizeUpdate($id);

        $this->regionService->update($request->only(['code', 'name']), $id);

        return redirect()->route('panel.regions.index')
            ->withSuccess(__('Region updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->regionService->authorizeDelete($id);

        return $this->regionService->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->regionService->authorizeViewAny();

        return $this->regionService->export($request->all());
    }
}
