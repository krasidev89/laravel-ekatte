<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\Panel\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\PermissionService  $permissionService
     * @return void
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->permissionService->authorizeViewAny();

        if ($request->ajax()) {
            $permissions = $this->permissionService->getPermissionsForDataTable($request->all());

            $datatable = datatables()->eloquent($permissions);

            $datatable->orderColumn('translations.display_name', function ($query, $order) {
                $query->orderBy('permission_translations.display_name', $order);
            });

            $datatable->addColumn('actions', function ($permission) {
                return view('panel.permissions.table.table-actions', compact('permission'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        return view('panel.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->permissionService->authorizeUpdate($id);

        $data = $this->permissionService->getEditData($id);

        return view('panel.permissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->permissionService->authorizeUpdate($id);

        $this->permissionService->update($request->only(['roles']), $id);

        return redirect()->route('panel.permissions.index')
            ->withSuccess(__('Permission updated successfully!'));
    }
}
