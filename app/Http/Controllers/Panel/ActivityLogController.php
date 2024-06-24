<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repositories\Panel\ActivityLogRepository;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    private $activityLogRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\Panel\ActivityLogRepository  $activityLogRepository
     * @return void
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->activityLogRepository->data($request->all());
        }

        $subjectTypes = $this->activityLogRepository->getAllSubjectTypes();
        $events = $this->activityLogRepository->getAllEvents();

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
        $activityLog = $this->activityLogRepository->findOrFail($id);

        return view('panel.activity-logs.show', compact('activityLog'));
    }
}
