<?php

namespace App\Services\Panel;

use App\Repositories\Panel\ActivityLogRepository;
use App\Services\Service;
use App\Traits\Authorizable;

class ActivityLogService extends Service
{
    use Authorizable;

    protected $repository;

    /**
     * Create a new service instance.
     *
     * @param  \App\Repositories\Panel\ActivityLogRepository  $activityLogRepository
     * @return void
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->repository = $activityLogRepository;
    }

    /**
     * Get activity logs for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getActivityLogsForDataTable(array $data)
    {
        return $this->repository->getActivityLogsForDataTable($data);
    }

    /**
     * Get all subject types.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSubjectTypes()
    {
        return $this->repository->getAllSubjectTypes();
    }

    /**
     * Get all event types.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEvents()
    {
        return $this->repository->getAllEvents();
    }
}
