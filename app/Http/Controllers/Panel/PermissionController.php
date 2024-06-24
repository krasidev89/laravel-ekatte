<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repositories\Panel\PermissionRepository;
use App\Repositories\Panel\RoleRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permissionRepository;
    private $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\PermissionRepository  $permissionRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
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
            return $this->permissionRepository->data($request->all());
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
        $permission = $this->permissionRepository->findOrFail($id);
        $permission->rolesIds = $permission->roles->pluck('id')->toArray();
        $roles = $this->roleRepository->all();

        return view('panel.permissions.edit', compact('permission', 'roles'));
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
        $this->permissionRepository->update($request->only(['roles']), $id);

        return redirect()->route('panel.permissions.index')
            ->withSuccess(__('Permission updated successfully!'));
    }
}
