<x-dashboard-layout>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
    </x-slot>

    <div class="card my-4 py-3">
        <h2 class="h4 font-weight-bold pl-4">
            @can('view admin dashboard')
            {{ __('Admin Dashboard') }}
            @endcan
            @can('view individual dashboard')
            {{ __('Supplier Dashboard') }}
            @endcan
            @can('view company dashboard')
            {{ __('Company Dashboard') }}
            @endcan
            @can('view shopkeeper dashboard')
            {{ __('shop Keeper Dashboard') }}
            @endcan
        </h2>
        <div class="card-body">
            @can('view admin dashboard')
            You're logged in as Admin
            @endcan
            @can('view individual dashboard')
            You're logged in as individual
            @endcan
            @can('view company dashboard')
            You're logged in as company
            @endcan
            @can('view shopkeeper dashboard')
            You're logged in as Shop Keeper
            @endcan
        </div>
    </div>
</x-dashboard-layout>
