@extends('layouts.panel')

@section('title', __('Create Region'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Regions') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.regions.index') }}">{{ __('List Regions') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.regions.create') }}">{{ __('Create Region') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header bg-transparent">{{ __('Create Region') }}</div>

    <div class="card-body">
        <form action="{{ route('panel.regions.store') }}" method="post" autocomplete="off">
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
                        <label for="name">{{ __('Name') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror">

                        @error('name')
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
