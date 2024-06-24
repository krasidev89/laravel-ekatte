<?php

namespace App\Repositories\Panel;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $users = $this->model->with('roles')
            ->select('users.*');

        if ($data['trashed']) {
            $users->onlyTrashed();
        }

        $startDate = $data['start_date'] ?? $data['end_date'];
        $endDate = $data['end_date'] ?? $data['start_date'];

        if ($startDate && $endDate) {
            $users->createdBetween($startDate, $endDate);
        }

        $datatable = datatables()->eloquent($users);

        $datatable->addColumn('roles', function ($user) {
            return $user->roles->map(function ($role) {
                return $role->name;
            })->implode(', ');
        });

        $datatable->addColumn('actions', function ($user) {
            return view('panel.users.table.table-actions', compact('user'));
        });

        return $datatable->make(true);
    }

    public function create(array $data)
    {
        $user = $this->model->create($data);

        $user->assignRole(Role::find($data['role'] ?? []));

        return $user;
    }

    public function update(array $data, $id)
    {
        if (!isset($data['password'])) {
            unset($data['password']);
        }

        $user = $this->model->findOrFail($id);

        $user->update($data);

        $user->syncRoles(Role::find($data['role'] ?? []));

        return $user;
    }

    public function delete($id)
    {
        if ($this->model->where('id', $id)->where('id', '<>', auth()->user()->id)->exists()) {
            return $this->model->destroy($id);
        }
    }
}
