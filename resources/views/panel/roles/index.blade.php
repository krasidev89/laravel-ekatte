@extends('layouts.panel')

@section('title', __('List Roles'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Roles') }}</li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.roles.index') }}">{{ __('List Roles') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('List Roles') }}</div>
    </div>

    <div class="card-body">
        <table id="roles-table" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Guard Name') }}</th>
                    <th>{{ __('Readonly') }}</th>
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
    $('#roles-table').DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: '{!! route('panel.roles.index') !!}',
            data: function(data) {
                $('[data-dt-toggle="tooltip"]').tooltip('dispose');
            },
            complete: function(data) {
                $('[data-dt-toggle="tooltip"]').tooltip();
            }
        },
        columns: [
            { data: 'id', name: 'id', searchable: false },
            { data: 'name', name: 'name' },
            { data: 'guard_name', name: 'guard_name' },
            { data: 'readonly', name: 'readonly' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', searchable: false, orderable: false, className: 'py-2' }
        ]
    });
</script>
@endsection
