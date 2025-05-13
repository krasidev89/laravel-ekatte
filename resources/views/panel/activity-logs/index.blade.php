@extends('layouts.panel')

@section('title', __('List Activity Logs'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Activity Logs') }}</li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.activity-logs.index') }}">{{ __('List Activity Logs') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('List Activity Logs') }}</div>
        <div class="btn-group btn-group-sm flex-shrink-0 ml-auto" role="group">
            <button type="button" class="btn p-0" data-dt-toggle="tooltip" data-placement="left" title="{{ __('Filters') }}" data-toggle="collapse" data-target="#activityLogsTableFilters" aria-expanded="false" aria-controls="activityLogsTableFilters">
                <i class="fas fa-filter text-primary"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <div id="activityLogsTableFilters" class="collapse">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <select name="subject_type" id="subject_type" class="form-control activity-logs-select2 activity-logs-table-filters">
                            <option value="0">{{ __('All Subject Types') }}</option>
                            @foreach($subjectTypes as $single)
                            <option value="{{ $single->subject_type }}">{{ $single->subject_type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <select name="event" id="event" class="form-control activity-logs-select2 activity-logs-table-filters">
                            <option value="0">{{ __('All Events') }}</option>
                            @foreach($events as $single)
                            <option value="{{ $single->event }}">{{ __($single->event) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <table id="activity-logs-table" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Subject Type') }}</th>
                    <th>{{ __('Event') }}</th>
                    <th>{{ __('Subject ID') }}</th>
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
    $('.activity-logs-select2').select2();

    var activityLogsTableFilters = $('.activity-logs-table-filters');
    var activityLogsTable = $('#activity-logs-table').DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        order: [
            [0, 'desc']
        ],
        ajax: {
            url: '{!! route('panel.activity-logs.index') !!}',
            data: function(data) {
                activityLogsTableFilters.each(function(index, element) {
                    data[element.name] = element.value;
                });

                $('[data-dt-toggle="tooltip"]').tooltip('dispose');
            },
            complete: function(data) {
                $('[data-dt-toggle="tooltip"]').tooltip();
            }
        },
        columns: [
            { data: 'id', name: 'id', searchable: false },
            { data: 'subject_type', name: 'subject_type' },
            { data: 'event', name: 'event' },
            { data: 'subject_id', name: 'subject_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'actions', name: 'actions', searchable: false, orderable: false, className: 'py-2' }
        ]
    });

    activityLogsTableFilters.on('change', function() {
        activityLogsTable.draw();
    });
</script>
@endsection
