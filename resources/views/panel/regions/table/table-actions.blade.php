<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.regions.edit'))
    <a href="{{ route('panel.regions.edit', ['region' => $region->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @endif
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.regions.destroy'))
        @if ($region->districts->isEmpty())
        <a href="{{ route('panel.regions.destroy', ['region' => $region->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
            <i class="fas fa-trash text-danger"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-trash text-muted"></i>
        </a>
        @endif
    @endif
</div>
