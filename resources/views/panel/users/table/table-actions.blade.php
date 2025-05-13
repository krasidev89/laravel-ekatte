<div class="btn-group btn-group-sm my-n2" role="group">
    @if ($user->trashed())
        @can('restore', $user)
        <a href="{{ route('panel.users.restore', ['user' => $user->id]) }}" class="btn dt-bt-restore" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Restore') }}">
            <i class="fas fa-trash-restore text-success"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-trash-restore text-muted"></i>
        </a>
        @endcan
        @can('forceDelete', $user)
        <a href="{{ route('panel.users.forceDelete', ['user' => $user->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Force delete') }}">
            <i class="fas fa-trash text-danger"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-trash text-muted"></i>
        </a>
        @endcan
    @else
        @can('update', $user)
        <a href="{{ route('panel.users.edit', ['user' => $user->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
            <i class="fas fa-edit text-primary"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-edit text-muted"></i>
        </a>
        @endcan
        @can('delete', $user)
        <a href="{{ route('panel.users.destroy', ['user' => $user->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
            <i class="fas fa-trash text-warning"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-trash text-muted"></i>
        </a>
        @endcan
    @endif
</div>
