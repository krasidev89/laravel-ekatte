@extends('layouts.panel')

@section('title', __('Edit Town Hall'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Town Halls') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.town-halls.index') }}">{{ __('Town Halls') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.town-halls.edit', ['town_hall' => $town_hall->id]) }}">{{ __('Edit Town Hall') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('Edit Town Hall') }}</div>

    <div class="card-body">
        <form action="{{ route('panel.town-halls.update', ['town_hall' => $town_hall->id]) }}" method="post" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="code">{{ __('Code') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="code" value="{{ old('code', $town_hall->code) }}" id="code" class="form-control @error('code') is-invalid @enderror">

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

                        <input type="text" name="ekatte" value="{{ old('ekatte', $town_hall->ekatte) }}" id="ekatte" class="form-control @error('ekatte') is-invalid @enderror">

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

                        <input type="text" name="name" value="{{ old('name', $town_hall->name) }}" id="name" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
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
                            $oldMunicipalities = old('municipality_id', $town_hall->municipality_id);
                        @endphp
                        <select name="municipality_id" id="municipality_id" class="form-control @error('municipality_id') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}">
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
            </div>

            <div class="border-bottom mb-3"></div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#municipality_id').select2();
</script>
@endsection
