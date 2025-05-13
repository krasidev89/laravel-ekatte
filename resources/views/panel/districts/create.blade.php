@extends('layouts.panel')

@section('title', __('Create District'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Districts') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.districts.index') }}">{{ __('List Districts') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.districts.create') }}">{{ __('Create District') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('Create District') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('panel.districts.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="code">{{ __('Code') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="code" value="{{ old('code') }}" id="code" class="form-control @error('code') is-invalid @enderror">

                        @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="ekatte">{{ __('EKATTE') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="ekatte" value="{{ old('ekatte') }}" id="ekatte" class="form-control @error('ekatte') is-invalid @enderror">

                        @error('ekatte')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="region_id">{{ __('Region') }}: <span class="text-danger">*</span></label>

                        @php
                            $oldRegions = old('region_id');
                        @endphp
                        <select name="region_id" id="region_id" class="form-control @error('region_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($regions as $region)
                                @php
                                    $selected = $region->id == $oldRegions ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $region->id }}" {!! $selected !!}>{{ $region->name }}</option>
                            @endforeach
                        </select>

                        @error('region_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-bottom mb-3"></div>

            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#region_id').select2();
</script>
@endsection
