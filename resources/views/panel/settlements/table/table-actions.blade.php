<div class="btn-group btn-group-sm" role="group">
    @can('update', $settlement)
    <a href="{{ route('panel.settlements.edit', ['settlement' => $settlement->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
    @can('delete', $settlement)
    <a href="{{ route('panel.settlements.destroy', ['settlement' => $settlement->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-trash text-muted"></i>
    </a>
    @endcan
</div>
