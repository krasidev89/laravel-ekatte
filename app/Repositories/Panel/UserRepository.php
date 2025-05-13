<?php

namespace App\Repositories\Panel;

use App\Models\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\User  $model
     * @return void
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get users for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getUsersForDataTable(array $data)
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

        return $users;
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
        $user = $this->model->findOrFail($id);

        $user->update($data);

        return $user;
    }
}
