<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sourcers') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">

</head>

<body class="c-app font-sans antialiased">
    @include('layouts.partials.dashboard.sidebar')
    <div class="c-wrapper">
        @include('layouts.partials.dashboard.header')

        <div class="c-body">
            <main class="c-main">

                <div class="container">
                    <div class="row fade-in">
                        <div class="col">
                            {{ $slot }}
                        </div>

                        @if (isset($aside))
                        <div class="col-lg-3">
                            {{ $aside ?? '' }}
                        </div>
                        @endif
                    </div>
                </div>

            </main>

           @include('layouts.partials.dashboard.footer')
        </div>
    </div>

    <script src="{{ mix('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>

</html>
