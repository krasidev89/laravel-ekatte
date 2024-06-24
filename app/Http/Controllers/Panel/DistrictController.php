<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\District\StoreDistrictRequest;
use App\Http\Requests\Panel\District\UpdateDistrictRequest;
use App\Repositories\Panel\DistrictRepository;
use App\Repositories\Panel\RegionRepository;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private $districtRepository;
    private $regionRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\DistrictRepository  $districtRepository
     * @param  \App\Repositories\Panel\RegionRepository  $regionRepository
     * @return void
     */
    public function __construct(DistrictRepository $districtRepository, RegionRepository $regionRepository)
    {
        $this->districtRepository = $districtRepository;
        $this->regionRepository = $regionRepository;
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
            return $this->districtRepository->data($request->all());
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
        $regions = $this->regionRepository->all();

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
        $this->districtRepository->create($request->only(['code', 'ekatte', 'name', 'region_id']));

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
        $district = $this->districtRepository->findOrFail($id);
        $regions = $this->regionRepository->all();

        return view('panel.districts.edit', compact('district', 'regions'));
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
        $this->districtRepository->update($request->only(['code', 'ekatte', 'name', 'region_id']), $id);

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
        return $this->districtRepository->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->districtRepository->export($request->all());
    }
}
