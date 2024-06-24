<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.activity-logs.show'))
    <a href="{{ route('panel.activity-logs.show', ['activity_log' => $activityLog->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Show') }}">
        <i class="fas fa-eye text-primary"></i>
    </a>
    @endif
</div>
