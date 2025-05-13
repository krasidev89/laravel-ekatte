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
    <style>
        #auth .card {
            width: 400px;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset(mix('js/app.js')) }}"></script>
</head>
<body>
    <div id="auth">
        <main>
            <div class="container-fluid">
                <div class="vh-100 d-flex flex-wrap justify-content-center align-items-center">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex align-items-center bg-transparent border-0">
                            <div class="card-title mb-0">@yield('title')</div>

                            <div class="btn-group btn-group-sm flex-shrink-0 ml-auto" role="group">
                                <div class="dropdown">
                                    @php
                                        $currentLocale = LaravelLocalization::getCurrentLocale();
                                    @endphp
                                    <button type="button" class="btn btn-link d-block border-0 text-decoration-none dropdown-toggle pl-2 pr-0 py-0" data-toggle="dropdown" aria-expanded="false">
                                        <span class="text-uppercase">{{ $currentLocale }}</span>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
                                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" @class(["dropdown-item", "disabled"=> $currentLocale == $localeCode])>
                                            {{ $properties['native'] }}
                                            (<span class="text-uppercase">{{ $localeCode }}</span>)
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

            @yield('scripts')
        </main>
    </div>
</body>
</html>
