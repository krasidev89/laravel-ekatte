<?php

namespace App\Repositories\Panel;

use App\Models\ActivityLog;
use App\Repositories\Repository;

class ActivityLogRepository extends Repository
{
    protected $model;

    /**
     * Create a new repository instance.
     *
     * @param  \App\Models\ActivityLog  $model
     * @return void
     */
    public function __construct(ActivityLog $model)
    {
        $this->model = $model;
    }

    /**
     * Get activity logs for DataTable.
     *
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getActivityLogsForDataTable(array $data)
    {
        $activityLogs = $this->model->select('activity_log.*');

        if ($data['subject_type']) {
            $activityLogs->where('subject_type', $data['subject_type']);
        }

        if ($data['event']) {
            $activityLogs->where('event', $data['event']);
        }

        return $activityLogs;
    }

    /**
     * Get all subject types.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSubjectTypes()
    {
        return $this->model->groupBy('subject_type')->get('subject_type');
    }

    /**
     * Get all event.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEvents()
    {
        return $this->model->groupBy('event')->get('event');
    }
}
