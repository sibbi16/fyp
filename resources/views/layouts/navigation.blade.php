<ul class="c-header-nav d-md-down-none">
    <li class="c-header-nav-item px-3">
        <x-nav-link href="{{ route('dashboard.dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </li>
</ul>
<ul class="c-header-nav ml-auto">
    <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar">
                <img class="c-avatar-img" src="assets/img/avatars/6.jpg" alt="user@email.com">
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
            <a class="dropdown-item" href="#">
                <svg class="c-icon mfe-2">
                    <use xlink:href="vendor/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Profile
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
            </form>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg class="c-icon mfe-2">
                    <use xlink:href="vendor/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> Logout
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


