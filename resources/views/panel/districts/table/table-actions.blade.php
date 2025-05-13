<div class="btn-group btn-group-sm" role="group">
    @can('update', $district)
    <a href="{{ route('panel.districts.edit', ['district' => $district->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
    @can('delete', $district)
    <a href="{{ route('panel.districts.destroy', ['district' => $district->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-trash text-muted"></i>
    </a>
    @endcan
</div>
