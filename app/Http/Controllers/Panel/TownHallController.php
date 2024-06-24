<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\TownHall\StoreTownHallRequest;
use App\Http\Requests\Panel\TownHall\UpdateTownHallRequest;
use App\Repositories\Panel\MunicipalityRepository;
use App\Repositories\Panel\TownHallRepository;
use Illuminate\Http\Request;

class TownHallController extends Controller
{
    private $townHallRepository;
    private $municipalityRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\TownHallRepository  $townHallRepository
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @return void
     */
    public function __construct(TownHallRepository $townHallRepository, MunicipalityRepository $municipalityRepository)
    {
        $this->townHallRepository = $townHallRepository;
        $this->municipalityRepository = $municipalityRepository;
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
            return $this->townHallRepository->data($request->all());
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
        $municipalities = $this->municipalityRepository->all();

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
        $this->townHallRepository->create($request->only(['code', 'ekatte', 'name', 'municipality_id']));

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
        $town_hall = $this->townHallRepository->findOrFail($id);
        $municipalities = $this->municipalityRepository->all();

        return view('panel.town-halls.edit', compact('town_hall', 'municipalities'));
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
        $this->townHallRepository->update($request->only(['code', 'ekatte', 'name', 'municipality_id']), $id);

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
        return $this->townHallRepository->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->townHallRepository->export($request->all());
    }
}
