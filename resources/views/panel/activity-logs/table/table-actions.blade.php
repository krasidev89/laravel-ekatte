<div class="btn-group btn-group-sm" role="group">
    @can('view', $activityLog)
    <a href="{{ route('panel.activity-logs.show', ['activity_log' => $activityLog->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Show') }}">
        <i class="fas fa-eye text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-eye text-muted"></i>
    </a>
    @endcan
</div>
