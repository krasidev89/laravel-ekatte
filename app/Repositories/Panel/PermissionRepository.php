<?php

namespace App\Repositories\Panel;

use App\Models\Permission;
use App\Repositories\Repository;
use Astrotomic\Translatable\Locales;

class PermissionRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\Permission  $model
     * @return void
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get permissions for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPermissionsForDataTable(array $data)
    {
        return $this->model->with('translations')->select('permissions.*')
            ->join('permission_translations', 'permissions.id', '=', 'permission_translations.permission_id')
            ->where('permission_translations.locale', app(Locales::class)->current());
    }

    /**
     * Get readonly roles associated with a permission.
     *
     * @param  \App\Models\Permission  $permission
     * @return array
     */
    public function getReadonlyRoles(Permission $permission)
    {
        return $permission->roles->where('readonly', 1)->pluck('id')->toArray();
    }
}
