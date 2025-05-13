<div class="btn-group btn-group-sm" role="group">
    @can('update', $region)
    <a href="{{ route('panel.regions.edit', ['region' => $region->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
    @can('delete', $region)
    <a href="{{ route('panel.regions.destroy', ['region' => $region->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-trash text-muted"></i>
    </a>
    @endcan
</div>
