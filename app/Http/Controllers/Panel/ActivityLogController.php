<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\Panel\ActivityLogService;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    protected $activityLogService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\Panel\ActivityLogService  $activityLogService
     * @return void
     */
    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->activityLogService->authorizeViewAny();

        if ($request->ajax()) {
            $activityLogs = $this->activityLogService->getActivityLogsForDataTable($request->all());

            $datatable = datatables()->eloquent($activityLogs);

            $datatable->editColumn('event', function ($activityLog) {
                return __($activityLog->event);
            });

            $datatable->addColumn('actions', function ($activityLog) {
                return view('panel.activity-logs.table.table-actions', compact('activityLog'));
            });

            $datatable->rawColumns(['actions']);

            return $datatable->make(true);
        }

        $subjectTypes = $this->activityLogService->getAllSubjectTypes();
        $events = $this->activityLogService->getAllEvents();

        return view('panel.activity-logs.index', compact('subjectTypes', 'events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->activityLogService->authorizeView($id);

        $activityLog = $this->activityLogService->findOrFail($id);

        return view('panel.activity-logs.show', compact('activityLog'));
    }
}
