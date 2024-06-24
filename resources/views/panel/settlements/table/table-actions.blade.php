<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.settlements.edit'))
        <a href="{{ route('panel.settlements.edit', ['settlement' => $settlement->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
            <i class="fas fa-edit text-primary"></i>
        </a>
    @endif
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.settlements.destroy'))
        <a href="{{ route('panel.settlements.destroy', ['settlement' => $settlement->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
            <i class="fas fa-trash text-danger"></i>
        </a>
    @endif
</div>
