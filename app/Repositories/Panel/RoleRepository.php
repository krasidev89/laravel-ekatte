<?php

namespace App\Repositories\Panel;

use App\Models\Role;
use App\Repositories\Repository;

class RoleRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Role  $model
     * @return void
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Get roles for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRolesForDataTable(array $data)
    {
        return $this->model->select('roles.*');
    }

    /**
     * Update the specified role.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\Role
     */
    public function update(array $data, $id)
    {
        $role = $this->model->findOrFail($id);

        $role->update($data);

        return $role;
    }

    /**
     * Get modifiable roles.
     *
     * @param  array  $ids
     * @return array
     */
    public function getModifiableRoles(array $ids)
    {
        return $this->model->whereIn('id', $ids)
            ->where('readonly', 0)
            ->pluck('id')
            ->toArray();
    }
}
