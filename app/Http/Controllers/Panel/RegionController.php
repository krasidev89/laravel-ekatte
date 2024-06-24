<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Region\StoreRegionRequest;
use App\Http\Requests\Panel\Region\UpdateRegionRequest;
use App\Repositories\Panel\RegionRepository;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private $regionRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\RegionRepository  $regionRepository
     * @return void
     */
    public function __construct(RegionRepository $regionRepository)
    {
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
            return $this->regionRepository->data($request->all());
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
        $this->regionRepository->create($request->only(['code', 'name']));

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
        $region = $this->regionRepository->findOrFail($id);

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
        $this->regionRepository->update($request->only(['code', 'name']), $id);

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
        return $this->regionRepository->delete($id);
    }

    /**
     * Export data from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        return $this->regionRepository->export($request->all());
    }
}
