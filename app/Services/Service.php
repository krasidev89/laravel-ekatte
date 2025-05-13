<?php

namespace App\Services;

use App\Repositories\Repository;

abstract class Service
{
    /**
     * @property Repository $repository;
     */
    protected $repository;

    /**
     * Find or fail resource by ID.
     *
     * @param  int|array  $id
     * @param  array  $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->repository->findOrFail($id, $columns);
    }

    /**
     * Create a new resource in storage.
     *
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  int  $id
     * @return bool|mixed
     */
    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|array  $id
     * @return bool|mixed
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->findOrFail($id)->delete();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->repository->restore($id);
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }
}
