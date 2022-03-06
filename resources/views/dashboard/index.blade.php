<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            @can('view admin dashboard')
            {{ __('Admin Dashboard') }}
            @endcan
            @can('view individual dashboard')
            {{ __('Supplier Dashboard') }}
            @endcan
            @can('view company dashboard')
            {{ __('Company Dashboard') }}
            @endcan
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">
            @can('view admin dashboard')
            You're logged in as Admin Admin
            @endcan
            @can('view individual dashboard')
            You're logged in as individual
            @endcan
            @can('view company dashboard')
            You're logged in as company
            @endcan
        </div>
    </div>
</x-dashboard-layout>
