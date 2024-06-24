<?php

namespace App\Repositories\Panel;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Repository;

class ProfileRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function update(array $data, $id)
    {
        $profile = $this->model->find($id);

        if (!isset($data['password'])) {
            unset($data['password']);

            $profile->syncRoles(Role::find($data['role'] ?? []));
        }

        $profile->update($data);

        return $profile;
    }

    public function delete($id)
    {
        $profile = $this->model->find($id);

        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return $profile->forceDelete();
    }
}
