<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Role\StoreRoleRequest;
use App\Http\Requests\Panel\Role\UpdateRoleRequest;
use App\Repositories\Panel\PermissionRepository;
use App\Repositories\Panel\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @param  \App\Repositories\Panel\PermissionRepository  $permissionRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
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
            return $this->roleRepository->data($request->all());
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
        $permissions = $this->permissionRepository->all();

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
        $this->roleRepository->create($request->only(['name', 'permissions']));

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
        $role = $this->roleRepository->findOrFail($id);
        $role->permissionsIds = $role->permissions->pluck('id')->toArray();
        $permissions = $this->permissionRepository->all();

        return view('panel.roles.edit', compact('role', 'permissions'));
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
        $this->roleRepository->update($request->only(['name', 'permissions']), $id);

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
        return $this->roleRepository->delete($id);
    }
}
