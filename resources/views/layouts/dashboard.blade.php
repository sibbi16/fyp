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
                    {{ $slot ?? ''}}
                </div>
            </main>

           @include('layouts.partials.dashboard.footer')
        </div>
    </div>

    <script src="{{ mix('js/dashboard.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    {{$scripts ?? ""}}
</body>

</html>
