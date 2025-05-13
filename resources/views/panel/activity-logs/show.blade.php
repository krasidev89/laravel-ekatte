@extends('layouts.panel')

@section('title', __('Preview Activity Log'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Activity Logs') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.activity-logs.index') }}">{{ __('List Activity Logs') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.activity-logs.show', ['activity_log' => $activityLog->id]) }}">{{ __('Preview Activity Log') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('Preview Activity Log') }}</div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="subject_type">{{ __('Subject Type') }}:</label>

                    <input type="text" value="{{ $activityLog->subject_type }}" id="subject_type" class="form-control">
                </div>
            </div>

            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="event">{{ __('Event') }}:</label>

                    <input type="text" value="{{ __($activityLog->event) }}" id="event" class="form-control">
                </div>
            </div>

            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="subject_id">{{ __('Subject ID') }}:</label>

                    <input type="text" value="{{ $activityLog->subject_id }}" id="subject_id" class="form-control">
                </div>
            </div>
        </div>

        <div class="border-bottom mb-3"></div>

        <div class="row mb-n3">
            @foreach ($activityLog['properties']['old'] ?? $activityLog['properties']['attributes'] as $key => $value)
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label for="{{ $key }}">{{ __($key) }}:</label>

                    @if (isset($activityLog['properties']['attributes'][$key]) && $activityLog['properties']['attributes'][$key] != $value)
                    <input type="text" value="{{ $value }} => {{ $activityLog['properties']['attributes'][$key] }}" id="{{ $key }}" class="form-control border-warning">
                    @else
                    <input type="text" value="{{ $value }}" id="{{ $key }}" class="form-control">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
