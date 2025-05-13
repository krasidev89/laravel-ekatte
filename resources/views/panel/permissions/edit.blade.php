@extends('layouts.panel')

@section('title', __('Edit Permission'))

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb border bg-white shadow-sm">
        <li class="breadcrumb-item pl-1">{{ __('Permissions') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('panel.permissions.index') }}">{{ __('List Permissions') }}</a>
        </li>
        <li class="breadcrumb-item pr-1">
            <a href="{{ route('panel.permissions.edit', ['permission' => $permission->id]) }}">{{ __('Edit Permission') }}</a>
        </li>
    </ol>
</nav>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center bg-transparent border-0">
        <div class="card-title mb-0">{{ __('Edit Permission') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('panel.permissions.update', ['permission' => $permission->id]) }}" method="post" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}:</label>

                        <input type="text" value="{{ $permission->display_name }}" id="name" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="guard_name">{{ __('Guard Name') }}:</label>

                        <input type="text" value="{{ $permission->guard_name }}" id="guard_name" class="form-control" readonly="readonly">
                    </div>
                </div>
            </div>

            <fieldset>
                <label>{{ __('Roles') }}:</label>

                <div class="border-bottom mb-3"></div>

                <div class="row">
                    @php
                        $oldRoles = old('roles', $permission->rolesIds ?? []);
                    @endphp
                    @foreach ($roles as $role)
                        @php
                            $checked = in_array($role->id, $oldRoles) ? 'checked="checked"' : '';
                            $disabled = $role->readonly ? 'disabled="disabled"' : '';
                        @endphp
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}" class="form-check-input" {!! $checked !!} {!! $disabled !!}>

                                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>

            <div class="border-bottom mb-3"></div>

            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </form>
    </div>
</div>
@endsection
