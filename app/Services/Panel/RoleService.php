<?php

namespace App\Services\Panel;

use App\Repositories\Panel\PermissionRepository;
use App\Repositories\Panel\RoleRepository;
use App\Services\Service;
use App\Traits\Authorizable;

class RoleService extends Service
{
    use Authorizable;

    protected $repository;
    protected $permissionRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @param  \App\Repositories\Panel\PermissionRepository  $permissionRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->repository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Get roles for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRolesForDataTable(array $data)
    {
        return $this->repository->getRolesForDataTable($data);
    }

    /**
     * Get all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermissions()
    {
        return $this->permissionRepository->all();
    }

    /**
     * Get edit data for a specific role.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $role = $this->repository->findOrFail($id);
        $role->permissionsIds = $role->permissions->pluck('id')->toArray();
        $permissions = $this->getAllPermissions();

        return compact('role', 'permissions');
    }

    /**
     * Create a new role.
     *
     * @param  array  $data
     * @return \App\Models\Role
     */
    public function create(array $data)
    {
        $role = $this->repository->create($data);

        $role->syncPermissions($this->permissionRepository->find($data['permissions'] ?? []));

        return $role;
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
        $role = $this->repository->findOrFail($id);

        if ($role->readonly == 0) {
            $role = $this->repository->update([
                'name' => $data['name']
            ], $id);

            $role->syncPermissions($this->permissionRepository->find($data['permissions'] ?? []));
        }

        return $role;
    }
}
