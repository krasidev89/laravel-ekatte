@extends('layouts.panel')

@section('title', __('List Regions'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Regions') }}</li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.regions.index') }}">{{ __('List Regions') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('List Regions') }}</div>
        <div class="btn-group btn-group-sm flex-shrink-0 ml-auto" role="group">
            <a href="{{ route('panel.regions.export') }}" class="btn p-0" data-dt-toggle="tooltip" data-placement="left" title="{{ __('Export All') }}">
                <i class="fas fa-download text-primary"></i>
            </a>
        </div>
    </div>

    <div class="card-body">
        <table id="regions-table" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Code') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Created') }}</th>
                    <th>{{ __('Updated') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('scripts.datatables')
<script>
    $('#regions-table').DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        order: [
            [0, 'desc']
        ],
        ajax: {
            url: '{!! route('panel.regions.index') !!}',
            data: function(data) {
                $('[data-dt-toggle="tooltip"]').tooltip('dispose');
            },
            complete: function(data) {
                $('[data-dt-toggle="tooltip"]').tooltip();
            }
        },
        columns: [
            { data: 'id', name: 'id', searchable: false },
            { data: 'code', name: 'code' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', searchable: false, orderable: false, className: 'py-2' }
        ]
    });
</script>
@endsection
