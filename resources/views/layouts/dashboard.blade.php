<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    <title>{{ isset($pageTitle) ? $pageTitle . " | " . config('app.name')  : "Dashboard | " . config('app.name') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
    <link rel="stylesheet" href="{{ mix('css/dashboard.css') }}">
    {{ $styles ?? "" }}
</head>

<body class="c-app font-sans antialiased">
    @include('layouts.partials.dashboard.sidebar')
    <div class="c-wrapper">
        @include('layouts.partials.dashboard.header')

        <div class="c-body">
            <main class="c-main">
                <div class="container">
                    <div class="mb-2">
                        <x-session-alerts />
                    </div>
                    {{ $slot ?? ''}}
                </div>
            </main>

           @include('layouts.partials.dashboard.footer')
        </div>
    </div>

    <script src="{{ mix('js/dashboard.js') }}"></script>
    <script>
        $('table').DataTable();
    </script>
    {{ $scripts ?? "" }}
</body>

</html>
