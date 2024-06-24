<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.permissions.edit'))
    <a href="{{ route('panel.permissions.edit', ['permission' => $permission->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @endif
</div>
