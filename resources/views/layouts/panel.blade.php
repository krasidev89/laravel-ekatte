<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    <!-- Custom Styles -->
    @yield('styles')

    <!-- Scripts -->
    <script src="{{ asset(mix('js/app.js')) }}"></script>
</head>
<body>
    <div id="panel" class="d-flex flex-column position-absolute inset-0">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark border-bottom shadow-sm">
            <div class="container-fluid px-0">
                <a href="{{ url('/') }}" class="navbar-brand">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="d-flex order-0 order-sm-1">
                    <button type="button" class="navbar-toggler button_hamburger_htx rounded-0" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span></span>
                    </button>

                    <button type="button" class="navbar-toggler button_hamburger_htra rounded-0 d-block d-md-none ml-2" data-toggle="collapse" data-target="#sideNavbarContent" aria-controls="sideNavbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span></span>
                    </button>
                </div>

                <div id="navbarContent" class="collapse navbar-collapse" data-parent="#panel">
                    <hr class="border-secondary mt-2 mb-0 d-sm-none">

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            @php
                                $currentLocale = LaravelLocalization::getCurrentLocale();
                            @endphp
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span class="text-uppercase">{{ $currentLocale }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right">
                                @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" @class(["dropdown-item", "disabled"=> $currentLocale == $localeCode])>
                                        {{ $properties['native'] }}
                                        (<span class="text-uppercase">{{ $localeCode }}</span>)
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ route('panel.profile.show') }}" @class(["dropdown-item", "active"=> request()->routeIs('panel.profile.show')])>
                                    <i class="fas fa-user mr-2"></i>{{ __('Profile') }}
                                </a>

                                <hr class="dropdown-divider">

                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off mr-2"></i>{{ __('Logout') }}
                                </a>

                                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex-grow-1 position-relative">
            <div class="d-flex flex-row-reverse flex-md-row position-absolute inset-0">
                <div class="d-flex flex-shrink-0 navbar-expand-md">
                    <div id="sideNavbarContent" class="collapse navbar-collapse width flex-fill bg-white shadow-sm" data-parent="#panel">
                        <nav id="panel-side-navbar">
                            <div class="input-group border-bottom has-clear p-3">
                                <input type="text" class="form-control searchbar" data-target="#panel-side-nav-group" placeholder="{{ __('Search in menu...') }}">

                                <div class="input-group-append">
                                    <button type="button" class="btn btn-clear">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="panel-side-nav-group" class="flex-grow-1 overflow-auto">
                                @php
                                    $htmlMenuNav = '';
                                    $currentRouteName = Route::currentRouteName();

                                    if ($sideMenu = config('menu.panel')) {
                                        foreach ($sideMenu as $module => $moduleOptions) {
                                            $icon = '';

                                            if (!empty($moduleOptions['icon'])) {
                                                $icon = '<i class="' . $moduleOptions['icon'] . ' mr-2"></i>';
                                            }

                                            if (isset($moduleOptions['routes'])) {
                                                $htmlMenuSubnav = '';

                                                foreach ($moduleOptions['routes'] as $route => $routeOptions) {
                                                    $showItem = true;

                                                    if (isset($routeOptions['role_or_permission'])) {
                                                        $rolesOrPermissions = is_array($routeOptions['role_or_permission'])
                                                            ? $routeOptions['role_or_permission']
                                                            : explode('|', $routeOptions['role_or_permission']);

                                                        $showItem = auth()->user()->canAny($rolesOrPermissions) || auth()->user()->hasAnyRole($rolesOrPermissions);
                                                    } else if (isset($routeOptions['permission'])) {
                                                        $permissions = is_array($routeOptions['permission'])
                                                            ? $routeOptions['permission']
                                                            : explode('|', $routeOptions['permission']);

                                                        $showItem = auth()->user()->canAny($permissions);
                                                    } else if (isset($routeOptions['role'])) {
                                                        $roles = is_array($routeOptions['role'])
                                                            ? $routeOptions['role']
                                                            : explode('|', $routeOptions['role']);

                                                        $showItem = auth()->user()->hasAnyRole($roles);
                                                    } else if (isset($routeOptions['can'])) {
                                                        $permission = $routeOptions['can'][0];
                                                        $model = $routeOptions['can'][1];

                                                        $showItem = auth()->user()->can($permission, new $model);
                                                    }

                                                    if ($showItem) {
                                                        $htmlMenuSubnav .= '<li class="nav-item">
                                                            <a href="' . route($route) . '" class="nav-link ' . ($currentRouteName == $route ? 'active' : '') . '">
                                                                ' . __($routeOptions['text']) . '
                                                            </a>
                                                        </li>';
                                                    }
                                                }

                                                if (!empty($htmlMenuSubnav)) {
                                                    $isModuleOpen = in_array($currentRouteName, array_merge(
                                                        array_keys($moduleOptions['routes']),
                                                        $moduleOptions['extended_routes'] ?? []
                                                    ));

                                                    $htmlMenuNav .= '<li class="nav-item">
                                                        <a href="#collapse-panel-' . $module . '" class="nav-link d-flex align-items-center ' . ($isModuleOpen ? 'default-expanded' : 'collapsed') . '"
                                                            data-toggle="collapse" aria-expanded="' . ($isModuleOpen ? 'true' : 'false') . '" aria-controls="collapse-panel-' . $module . '">
                                                            ' . $icon . __($moduleOptions['text']) . '
                                                            <i class="plus-minus-rotate flex-shrink-0 ml-auto collapsed"></i>
                                                        </a>';

                                                    $htmlMenuNav .= '<div id="collapse-panel-' . $module . '" class="collapse ' . ($isModuleOpen ? 'show' : '') . '">
                                                            <ul class="nav flex-column">' . $htmlMenuSubnav . '</ul>
                                                        </div>
                                                    </li>';
                                                }
                                            } else {
                                                $showItem = true;

                                                if (isset($moduleOptions['role_or_permission'])) {
                                                    $rolesOrPermissions = is_array($moduleOptions['role_or_permission'])
                                                        ? $moduleOptions['role_or_permission']
                                                        : explode('|', $moduleOptions['role_or_permission']);

                                                    $showItem = auth()->user()->canAny($rolesOrPermissions) || auth()->user()->hasAnyRole($rolesOrPermissions);
                                                } else if (isset($moduleOptions['permission'])) {
                                                    $permissions = is_array($moduleOptions['permission'])
                                                        ? $moduleOptions['permission']
                                                        : explode('|', $moduleOptions['permission']);

                                                    $showItem = auth()->user()->canAny($permissions);
                                                } else if (isset($moduleOptions['role'])) {
                                                    $roles = is_array($moduleOptions['role'])
                                                        ? $moduleOptions['role']
                                                        : explode('|', $moduleOptions['role']);

                                                    $showItem = auth()->user()->hasAnyRole($roles);
                                                } else if (isset($moduleOptions['can'])) {
                                                    $permission = $moduleOptions['can'][0];
                                                    $model = $moduleOptions['can'][1];

                                                    $showItem = auth()->user()->can($permission, new $model);
                                                }

                                                if ($showItem) {
                                                    $htmlMenuNav .= '<li class="nav-item">
                                                        <a href="' . route($moduleOptions['route']) . '" class="nav-link ' . ($currentRouteName == $moduleOptions['route'] ? 'active' : '') . '">
                                                            ' . $icon . __($moduleOptions['text']) . '
                                                        </a>
                                                    </li>';
                                                }
                                            }
                                        }
                                    }
                                @endphp
                                <ul class="nav flex-column">{!! $htmlMenuNav !!}</ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <main class="flex-md-shrink-1 flex-shrink-0 w-100 overflow-auto pt-3">
                    <div class="container-fluid mb-3">
                        @yield('content')
                    </div>

                    @yield('scripts')
                </main>
            </div>
        </div>
    </div>

    @if (session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ session('status') }}',
            confirmButtonText: '{{ __('Close') }}',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'swal2-styled btn btn-primary m-1'
            }
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ session('success') }}',
            confirmButtonText: '{{ __('Close') }}',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'swal2-styled btn btn-primary m-1'
            }
        });
    </script>
    @endif
</body>
</html>
