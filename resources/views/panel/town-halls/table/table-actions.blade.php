<div class="btn-group btn-group-sm" role="group">
    @can('update', $townHall)
    <a href="{{ route('panel.town-halls.edit', ['town_hall' => $townHall->id]) }}" class="btn" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}">
        <i class="fas fa-edit text-primary"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-edit text-muted"></i>
    </a>
    @endcan
    @can('delete', $townHall)
    <a href="{{ route('panel.town-halls.destroy', ['town_hall' => $townHall->id]) }}" class="btn dt-bt-delete" data-dt-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}">
        <i class="fas fa-trash text-danger"></i>
    </a>
    @else
    <a href="#" class="btn disabled">
        <i class="fas fa-trash text-muted"></i>
    </a>
    @endcan
</div>
