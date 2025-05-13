<?php

namespace App\Services\Panel;

use App\Repositories\Panel\RoleRepository;
use App\Repositories\Panel\UserRepository;
use App\Services\Service;
use App\Traits\Authorizable;

class UserService extends Service
{
    use Authorizable;

    protected $repository;
    protected $roleRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\UserRepository  $userRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->repository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get users for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getUsersForDataTable(array $data)
    {
        return $this->repository->getUsersForDataTable($data);
    }

    /**
     * Get all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return $this->roleRepository->all();
    }

    /**
     * Get edit data for a specific user.
     *
     * @param  int  $id
     * @return array
     */
    public function getEditData($id)
    {
        $user = $this->repository->findOrFail($id);
        $roles = $this->getAllRoles();

        return compact('user', 'roles');
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $user = $this->repository->create($data);

        $user->assignRole($this->roleRepository->find($data['role'] ?? []));

        return $user;
    }

    /**
     * Update the specified user.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\User
     */
    public function update(array $data, $id)
    {
        if (!isset($data['password'])) {
            unset($data['password']);
        }

        $user = $this->repository->update($data, $id);

        $user->syncRoles($this->roleRepository->find($data['role'] ?? []));

        return $user;
    }
}
