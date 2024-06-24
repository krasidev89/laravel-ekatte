@if ($role->readonly == 0)
<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.roles.edit'))
    <a href="{{ route('panel.roles.edit', ['role' => $role->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @endif
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.roles.destroy'))
    <a href="{{ route('panel.roles.destroy', ['role' => $role->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @endif
</div>
@endif
