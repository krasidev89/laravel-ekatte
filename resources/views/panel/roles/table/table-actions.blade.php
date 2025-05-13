<div class="btn-group btn-group-sm" role="group">
    @can('update', $role)
    <a href="{{ route('panel.roles.edit', ['role' => $role->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
    @can('delete', $role)
    <a href="{{ route('panel.roles.destroy', ['role' => $role->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-trash text-muted"></i>
    </a>
    @endcan
</div>
