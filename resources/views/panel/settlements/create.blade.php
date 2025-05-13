@extends('layouts.panel')

@section('title', __('Create Settlement'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Settlements') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.settlements.index') }}">{{ __('List Settlements') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.settlements.create') }}">{{ __('Create Settlement') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('Create Settlement') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('panel.settlements.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="row">
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
                        <label for="settlement_kind_id">{{ __('Kind') }}: <span class="text-danger">*</span></label>

                        @php
                            $oldSettlementKinds = old('settlement_kind_id');
                        @endphp
                        <select name="settlement_kind_id" id="settlement_kind_id" class="form-control settlements-select2 @error('settlement_kind_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($settlementKinds as $settlementKind)
                                @php
                                    $selected = $settlementKind->id == $oldSettlementKinds ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $settlementKind->id }}" {!! $selected !!}>{{ $settlementKind->name }}</option>
                            @endforeach
                        </select>

                        @error('settlement_kind_id')
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
                        <label for="district_id">{{ __('District') }}: <span class="text-danger">*</span></label>

                        @php
                            $oldDistricts = old('district_id');
                        @endphp
                        <select name="district_id" id="district_id" class="form-control settlements-select2 @error('district_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($districts as $district)
                                @php
                                    $selected = $district->id == $oldDistricts ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $district->id }}" {!! $selected !!}>{{ $district->name }}</option>
                            @endforeach
                        </select>

                        @error('district_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="municipality_id">{{ __('Municipality') }}: <span class="text-danger">*</span></label>

                        @php
                            $oldMunicipalities = old('municipality_id');
                        @endphp
                        <select name="municipality_id" id="municipality_id" class="form-control settlements-select2 @error('municipality_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}" @if($municipalities->isEmpty()) disabled="disabled" @endif>
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($municipalities as $municipality)
                                @php
                                    $selected = $municipality->id == $oldMunicipalities ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $municipality->id }}" {!! $selected !!}>{{ $municipality->name }}</option>
                            @endforeach
                        </select>

                        @error('municipality_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="town_hall_id">{{ __('Town Hall') }}: <span class="text-danger">*</span></label>

                        @php
                            $oldTownHalls = old('town_hall_id');
                        @endphp
                        <select name="town_hall_id" id="town_hall_id" class="form-control settlements-select2 @error('town_hall_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}" @if($townHalls->isEmpty()) disabled="disabled" @endif>
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($townHalls as $townHall)
                                @php
                                    $selected = $townHall->id == $oldTownHalls ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $townHall->id }}" {!! $selected !!}>{{ $townHall->name }}</option>
                            @endforeach
                        </select>

                        @error('town_hall_id')
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
@include('panel.settlements.scripts.filters')
@endsection
