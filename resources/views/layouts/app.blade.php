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
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand">
            <a href="/">
                <x-application-logo class="c-sidebar-brand-minimized" width="40" />
                <x-application-logo class="c-sidebar-brand-full" width="120" />
            </a>
        </div>

        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendor/@coreui/icons/svg/free.svg#cil-speedometer"></use>

                    </svg> Dashboard<span class="badge badge-info">NEW</span></a>
            </li>
            @can('view admin dashboard')
            <li class="c-sidebar-nav-title">user</li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendor/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg> Users</a>
            </li>
            @endcan

            <li class="c-sidebar-nav-title">Account</li>
            <li class="c-sidebar-nav-item">
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
                <a class="c-sidebar-nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendor/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                    </svg> Logout
                </a>
            </li>
            {{ $sidebar ?? '' }}
        </ul>

        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <button class="c-header-toggler c-class-toggler d-lg-none me-auto" type="button" data-target="#sidebar"
                data-class="c-sidebar-show">
                <span class="c-header-toggler-icon"></span>
            </button>

            <button class="c-header-toggler c-class-toggler ms-3 d-md-down-none" type="button" data-target="#sidebar"
                data-class="c-sidebar-lg-show" responsive="true">
                <span class="c-header-toggler-icon"></span>
            </button>

            @include('layouts.navigation')

            <div class="c-subheader px-3 py-3">
                <div class="container">
                    {{ $header }}
                </div>
            </div>
        </header>

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

            <footer class="c-footer">
                <div class="text-center">
                    Copyright &copy; {{now()->year}} Sourcers. All Rights Reserved.
                </div>
                <div class="ms-auto"> Design Developed & Managed by<a href="#"> Sibghat & Usama</a></div>
            </footer>
        </div>
    </div>

    <script src="{{ mix('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>

</html>
