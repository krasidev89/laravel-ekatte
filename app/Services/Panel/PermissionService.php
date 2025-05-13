<?php

namespace App\Services\Panel;

use App\Repositories\Panel\PermissionRepository;
use App\Repositories\Panel\RoleRepository;
use App\Services\Service;
use App\Traits\Authorizable;

class PermissionService extends Service
{
    use Authorizable;

    protected $repository;
    protected $roleRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\PermissionRepository  $permissionRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(PermissionRepository $permissionRepository, RoleRepository $roleRepository)
    {
        $this->repository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get permissions for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPermissionsForDataTable(array $data)
    {
        return $this->repository->getPermissionsForDataTable($data);
    }

    /**
     * Get edit data for a specific permission.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $permission = $this->repository->findOrFail($id);
        $permission->rolesIds = $permission->roles->pluck('id')->toArray();
        $roles = $this->roleRepository->all();

        return compact('permission', 'roles');
    }

    /**
     * Update the specified permission.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\Permission
     */
    public function update(array $data, $id)
    {
        $permission = $this->repository->findOrFail($id);

        $readonlyRoles = $this->repository->getReadonlyRoles($permission);

        $modifiableRoles = $this->roleRepository->getModifiableRoles($data['roles'] ?? []);

        $finalRoles = array_merge($readonlyRoles, $modifiableRoles);

        $permission->syncRoles($finalRoles);

        return $permission;
    }
}
