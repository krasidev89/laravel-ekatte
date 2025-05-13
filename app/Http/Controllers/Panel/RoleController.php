<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Role\StoreRoleRequest;
use App\Http\Requests\Panel\Role\UpdateRoleRequest;
use App\Services\Panel\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\RoleService  $roleService
     * @return void
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->roleService->authorizeViewAny();

        if ($request->ajax()) {
            $roles = $this->roleService->getRolesForDataTable($request->all());

            $datatable = datatables()->eloquent($roles);

            $datatable->editColumn('readonly', function ($role) {
                return view('panel.roles.table.table-readonly', compact('role'));
            });

            $datatable->addColumn('actions', function ($role) {
                return view('panel.roles.table.table-actions', compact('role'));
            });

            $datatable->rawColumns(['readonly', 'actions']);

            return $datatable->make(true);
        }

        return view('panel.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->roleService->authorizeCreate();

        $permissions = $this->roleService->getAllPermissions();

        return view('panel.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Role\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roleService->authorizeCreate();

        $this->roleService->create($request->only(['name', 'permissions']));

        return redirect()->route('panel.roles.index')
            ->withSuccess(__('Role added successfully!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->roleService->authorizeUpdate($id);

        $data = $this->roleService->getEditData($id);

        return view('panel.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Panel\Role\UpdateRoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $this->roleService->authorizeUpdate($id);

        $this->roleService->update($request->only(['name', 'permissions']), $id);

        return redirect()->route('panel.roles.index')
            ->withSuccess(__('Role updated successfully!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roleService->authorizeDelete($id);

        return $this->roleService->delete($id);
    }
}
