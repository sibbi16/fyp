<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <a href="/">
            <x-application-logo class="c-sidebar-brand-minimized" width="40" />
            <x-application-logo class="c-sidebar-brand-full" width="120" />
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{route('dashboard.index')}}">
            <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-speedometer" />
                Dashboard
            </a>
        </li>
        @can('view admin dashboard')
        <li class="c-sidebar-nav-title">users</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if (request()->routeIs('dashboard.users.*')) c-active @endif" href="{{route('dashboard.users.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-user" />
                Users
            </a>
        </li>
        @endcan
        @can('view company dashboard')
        <li class="c-sidebar-nav-title">Suppliers</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if (request()->routeIs('dashboard.suppliers.*')) c-active @endif" href="{{route('dashboard.suppliers.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-user" />
                Suppliers
            </a>
        </li>
        @endcan
        <li class="c-sidebar-nav-title">Warehouses</li>
        @can('view admin dashboard')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if (request()->routeIs('dashboard.warehouses.*')) c-active @endif" href="{{route('dashboard.warehouses.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-house" />
                 Warehouses
            </a>
        </li>
        @endcan
        @canany(['view company dashboard','view supplier dashboard'])
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link @if (request()->routeIs('dashboard.warehouses.*')) c-active @endif" href="{{route('dashboard.warehouses.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-house" />
                Warehouse
            </a>
        </li>
        @endcanany
        @can('view admin dashboard')
        <li class="c-sidebar-nav-title">Products</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('dashboard.all_products.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-inbox" />
                All Products
            </a>
        </li>
        @endcan
        @canany(['view admin dashboard','view company dashboard','view supplier dashboard'])
        <li class="c-sidebar-nav-title">Orders</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('dashboard.orders.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-cart" />
                Orders
            </a>
        </li>
        @endcanany
        @canany(['view admin dashboard' , 'view company dashboard'])
        <li class="c-sidebar-nav-title">Products Category</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('dashboard.category.index')}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-library" />
                Product Categories
            </a>
        </li>
        @endcanany


        <li class="c-sidebar-nav-title">Account</li>
        @canany(['view company dashboard','view supplier dashboard','view shopkeeper dashboard'])
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link  @if (request()->routeIs('dashboard.users.*')) c-active @endif" href="{{route('dashboard.users.show', auth()->user()->username)}}">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-user" />
                Profile
            </a>
        </li>
        @endcanany
        <li class="c-sidebar-nav-item">
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
            </form>
            <a class="c-sidebar-nav-link" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <x-core-ui-icon class="c-sidebar-nav-icon" name="cil-account-logout" />
                Logout
            </a>
        </li>
        {{ $sidebar ?? '' }}
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
