<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <button class="c-header-toggler c-class-toggler d-lg-none me-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show">
        <span class="c-header-toggler-icon"></span>
    </button>

    <button class="c-header-toggler c-class-toggler ms-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true">
        <span class="c-header-toggler-icon"></span>
    </button>
    {{-- header goes here --}}
    <ul class="c-header-nav d-md-down-none">
        <li class="c-header-nav-item px-3">
            <x-nav-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </li>
    </ul>
    <ul class="c-header-nav ml-auto">
        <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ auth()->user()->avatar_url}}" alt="{{auth()->user()->initials}}">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item" href="{{route('dashboard.users.show', auth()->user()->username)}}">
                    <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-user" />
                    Profile
                </a>
                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                    @csrf
                </form>
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-account-logout" />
                    Logout
                </a>


            </div>
        </li>
        <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside"
            data-class="c-sidebar-show">
            <svg class="c-icon c-icon-lg">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
            </svg>
        </button>
    </ul>
    @if($breadcrumb)
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            {{ $breadcrumb ?? '' }}
        </ol>
    </div>
    @endif
</header>
