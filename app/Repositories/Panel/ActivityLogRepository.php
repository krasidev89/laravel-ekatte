<?php

namespace App\Repositories\Panel;

use App\Models\ActivityLog;
use App\Repositories\Repository;

class ActivityLogRepository extends Repository
{
    protected $model;

    public function __construct(ActivityLog $model)
    {
        $this->model = $model;
    }

    public function data($data)
    {
        $activityLogs = $this->model->select('activity_log.*');

        if ($data['subject_type']) {
            $activityLogs->where('subject_type', $data['subject_type']);
        }

        if ($data['event']) {
            $activityLogs->where('event', $data['event']);
        }

        $datatable = datatables()->eloquent($activityLogs);

        $datatable->editColumn('event', function ($activityLog) {
            return __($activityLog->event);
        });

        $datatable->addColumn('actions', function ($activityLog) {
            return view('panel.activity-logs.table.table-actions', compact('activityLog'));
        });

        return $datatable->make(true);
    }

    public function getAllSubjectTypes()
    {
        return $this->model->groupBy('subject_type')->get('subject_type');
    }

    public function getAllEvents()
    {
        return $this->model->groupBy('event')->get('event');
    }
}
