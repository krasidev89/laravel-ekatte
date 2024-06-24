<?php

namespace App\Repositories\Panel;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Repository;

class RoleRepository extends Repository
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $roles = $this->model->select('roles.*');

        $datatable = datatables()->eloquent($roles);

        $datatable->editColumn('readonly', function ($role) {
            return view('panel.roles.table.table-readonly', compact('role'));
        });

        $datatable->addColumn('actions', function ($role) {
            return view('panel.roles.table.table-actions', compact('role'));
        });

        return $datatable->make(true);
    }

    public function create($data)
    {
        $role = $this->model->create([
            'name' => $data['name']
        ]);

        $role->syncPermissions(Permission::find($data['permissions'] ?? []));

        return $role;
    }

    public function update(array $data, $id)
    {
        $role = $this->model->findOrFail($id);

        if ($role->readonly == 0) {
            $role->update([
                'name' => $data['name']
            ]);

            $role->syncPermissions(Permission::find($data['permissions'] ?? []));
        }

        return $role;
    }

    public function delete($id)
    {
        if ($this->model->where([
            'id' => $id,
            'readonly' => 0
        ])->exists()) {
            return $this->model->destroy($id);
        }
    }
}
