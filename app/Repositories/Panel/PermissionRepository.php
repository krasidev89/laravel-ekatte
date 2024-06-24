<?php

namespace App\Repositories\Panel;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $permissions = $this->model->with('translations')
            ->select('permissions.*');

        $datatable = datatables()->eloquent($permissions);

        $datatable->addColumn('actions', function ($permission) {
            return view('panel.permissions.table.table-actions', compact('permission'));
        });

        return $datatable->make(true);
    }

    public function update(array $data, $id)
    {
        $permission = $this->model->findOrFail($id);
        $readonlyRoles = $permission->roles->where('readonly', 1)->pluck('id')->toArray();
        $roles = Role::whereIn('id', $data['roles'] ?? [])->where('readonly', 0)->pluck('id')->toArray();

        $permission->syncRoles(array_merge(
            $readonlyRoles,
            $roles
        ));

        return $permission;
    }
}
