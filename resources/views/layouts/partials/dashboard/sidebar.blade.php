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
            <a class="c-sidebar-nav-link" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
