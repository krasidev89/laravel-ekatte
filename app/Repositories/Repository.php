<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @property Model $model;
     */
    protected $model;

    /**
     * Get model class.
     *
     * @return string
     */
    public function getModelClass()
    {
        return $this->model::class;
    }

    /**
     * All resource.
     *
     * @param  array  $columns
     * @return Collection|null
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * List resource.
     *
     * @param  string|int  $orderByColumn
     * @param  string  $orderBy
     * @param  string|array  $with
     * @param  array  $columns
     * @return Collection|null
     */
    public function list($orderByColumn, $orderBy = 'desc', $with = [], $columns = ['*'])
    {
        return $this->model->with($with)
            ->orderBy($orderByColumn, $orderBy)
            ->get($columns);
    }

    /**
     * Find resource by ID
     *
     * @param  int|array  $id
     * @param  array  $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find or fail resource by ID.
     *
     * @param  int|array  $id
     * @param  array  $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Find resource by custom field.
     *
     * @param  string  $field
     * @param  mixed  $value
     * @param  array  $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)
            ->select($columns)
            ->first();
    }

    /**
     * Create a new resource in storage.
     *
     * @param  array  $data
     * @return Model|null
     */
    public function create(array $data)
    {
        return $this->model->create($data);
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
        return $this->model->findOrFail($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|array  $id
     * @return bool|mixed
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Get the model instance including soft deleted records.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function withTrashed()
    {
        return $this->model->withTrashed();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function restore($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->restore();
    }

    /**
     * Force delete the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function forceDelete($id)
    {
        return $this->model->withTrashed()->findOrFail($id)->forceDelete();
    }
}
