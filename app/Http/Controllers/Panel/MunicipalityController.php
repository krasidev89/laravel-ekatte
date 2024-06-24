<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Municipality\StoreMunicipalityRequest;
use App\Http\Requests\Panel\Municipality\UpdateMunicipalityRequest;
use App\Repositories\Panel\DistrictRepository;
use App\Repositories\Panel\MunicipalityRepository;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    private $municipalityRepository;
    private $districtRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\MunicipalityRepository  $municipalityRepository
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @return void
     */
    public function __construct(MunicipalityRepository $municipalityRepository, DistrictRepository $districtRepository)
    {
        $this->municipalityRepository = $municipalityRepository;
        $this->districtRepository = $districtRepository;
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
            return $this->municipalityRepository->data($request->all());
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
        $districts = $this->districtRepository->all();

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
        $this->municipalityRepository->create($request->only(['code', 'ekatte', 'name', 'district_id']));

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
        $municipality = $this->municipalityRepository->findOrFail($id);
        $districts = $this->districtRepository->all();

        return view('panel.municipalities.edit', compact('municipality', 'districts'));
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
        $this->municipalityRepository->update($request->only(['code', 'ekatte', 'name', 'district_id']), $id);

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
        return $this->municipalityRepository->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->municipalityRepository->export($request->all());
    }
}
