<div class="btn-group btn-group-sm" role="group">
    @can('update', $permission)
    <a href="{{ route('panel.permissions.edit', ['permission' => $permission->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
</div>
