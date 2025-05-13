@extends('layouts.panel')

@section('title', __('Create User'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Users') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.users.index') }}">{{ __('List Users') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.users.create') }}">{{ __('Create User') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('Create User') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('panel.users.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="row">
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
                        <label for="email">{{ __('Email Address') }}: <span class="text-danger">*</span></label>

                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="role">{{ __('Role') }}:</label>

                        @php
                            $oldRole = old('role');
                        @endphp
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" data-placeholder="{{ __('Select an option') }}">
                            <option value="">{{ __('Select an option') }}</option>
                            @foreach($roles as $role)
                                @php
                                    $selected = $role->id == $oldRole ? 'selected="selected"' : '';
                                @endphp
                                <option value="{{ $role->id }}" {!! $selected !!}>{{ $role->name }}</option>
                            @endforeach
                        </select>

                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}: <span class="text-danger">*</span></label>

                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirm Password') }}: <span class="text-danger">*</span></label>

                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control">
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
    $('#role').select2({
        allowClear: true
    });
</script>
@endsection
