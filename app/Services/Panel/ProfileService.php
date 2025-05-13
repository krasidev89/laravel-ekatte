<?php

namespace App\Services\Panel;

use App\Repositories\Panel\ProfileRepository;
use App\Repositories\Panel\RoleRepository;
use App\Services\Service;

class ProfileService extends Service
{
    protected $repository;
    private $roleRepository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\ProfileRepository  $profileRepository
     * @param  \App\Repositories\Panel\RoleRepository  $roleRepository
     * @return void
     */
    public function __construct(ProfileRepository $profileRepository, RoleRepository $roleRepository)
    {
        $this->repository = $profileRepository;
        $this->roleRepository = $roleRepository;
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
     * Update the profile of a user.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \App\Models\User
     */
    public function update(array $data, $id)
    {
        $profile = $this->repository->findOrFail($id);

        if (!isset($data['password'])) {
            unset($data['password']);

            $profile->syncRoles($this->roleRepository->find($data['role'] ?? []));
        }

        $this->repository->update($data, $id);

        return $profile;
    }

    /**
     * Delete the user profile.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function delete($id)
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return $this->repository->forceDelete($id);
    }
}
