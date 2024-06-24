<div class="btn-group btn-group-sm" role="group">
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.municipalities.edit'))
    <a href="{{ route('panel.municipalities.edit', ['municipality' => $municipality->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @endif
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasPermissionTo('panel.municipalities.destroy'))
        @if ($municipality->townHalls->isEmpty())
        <a href="{{ route('panel.municipalities.destroy', ['municipality' => $municipality->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
            <i class="fas fa-trash text-danger"></i>
        </a>
        @else
        <a href="#" class="btn disabled">
            <i class="fas fa-trash text-muted"></i>
        </a>
        @endif
    @endif
</div>
