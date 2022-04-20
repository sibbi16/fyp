<x-dashboard-layout>
    <x-slot name="pageTitle">
        Warehouses
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Warehouses</a></li>
        <li class="breadcrumb-item active">List</li>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                 $('#warehouseList').DataTable();
            });
        </script>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Warehouses</h1>
                        <a href="{{route('dashboard.warehouses.create')}}" class="btn btn-primary text-white">Create Warehouse</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg" id="warehouseList">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warehouses as $warehouse)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">
                                        <div class="c-avatar">
                                            <img class="c-avatar-img" src="{{ $warehouse->avatar_url }}" alt="warehouse image">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $warehouse->warehouse_name }}
                                    </td>
                                    <td>
                                        {{ $warehouse->warehouse_address }}
                                    </td>
                                    <td>
                                        {{ $warehouse->warehouse_phone }}
                                    </td>
                                    <td>
                                        {{$warehouse->created_at->format('d M Y h:i A')}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('dashboard.warehouses.products.index',$warehouse->id)}}" class="btn btn-secondary">Show Products</a>
                                            <a href="{{route('dashboard.warehouses.show',$warehouse->warehouse_name)}}" class="btn btn-info">View</a>
                                            <a href="{{route('dashboard.warehouses.edit', $warehouse->warehouse_name)}}" class="btn btn-warning text-white">Edit</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deletewarehouseModel{{ $warehouse->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($warehouses as $warehouse)
        <div class="modal fade" id="deletewarehouseModel{{ $warehouse->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel_{{ $warehouse->warehouse_name }}" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <form class="modal-content" action="{{ route('dashboard.warehouses.destroy', $warehouse->warehouse_name) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel_{{ $warehouse->warehouse_name }}">Confirm delete user?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user <strong>[{{ $warehouse->warehouse_name }}]</strong> and all its
                            associated data from the system?</p>
                        <p><strong><em>Note: </em>This action is not reversible!</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-dashboard-layout>
