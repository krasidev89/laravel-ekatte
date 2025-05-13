<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\TownHall\StoreTownHallRequest;
use App\Http\Requests\Panel\TownHall\UpdateTownHallRequest;
use App\Services\Panel\TownHallService;
use Illuminate\Http\Request;

class TownHallController extends Controller
{
    protected $townHallService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\TownHallService  $townHallService
     * @return void
     */
    public function __construct(TownHallService $townHallService)
    {
        $this->townHallService = $townHallService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->townHallService->authorizeViewAny();

        if ($request->ajax()) {
            $townHalls = $this->townHallService->getTownHallsForDataTable($request->all());

            $datatable = datatables()->eloquent($townHalls);

            $datatable->addColumn('actions', function ($townHall) {
                return view('panel.town-halls.table.table-actions', compact('townHall'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.town-halls.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->townHallService->authorizeCreate();

        $municipalities = $this->townHallService->getAllMunicipalities();

        return view('panel.town-halls.create', compact('municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\TownHall\StoreTownHallRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTownHallRequest $request)
    {
        $this->townHallService->authorizeCreate();

        $this->townHallService->create($request->only(['code', 'ekatte', 'name', 'municipality_id']));

        return redirect()->route('panel.town-halls.index')
            ->withSuccess(__('Town hall added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->townHallService->authorizeUpdate($id);

        $data = $this->townHallService->getEditData($id);

        return view('panel.town-halls.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\TownHall\UpdateTownHallRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTownHallRequest $request, $id)
    {
        $this->townHallService->authorizeUpdate($id);

        $this->townHallService->update($request->only(['code', 'ekatte', 'name', 'municipality_id']), $id);

        return redirect()->route('panel.town-halls.index')
            ->withSuccess(__('Town hall updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->townHallService->authorizeDelete($id);

        return $this->townHallService->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->townHallService->authorizeViewAny();

        return $this->townHallService->export($request->all());
    }
}
