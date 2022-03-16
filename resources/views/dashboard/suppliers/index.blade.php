<x-dashboard-layout>
    <x-slot name="pageTitle">
        Suppliers
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Users</a></li>
        <li class="breadcrumb-item active">List</li>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                 $('#userIdList').DataTable();
            });
        </script>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Suppliers</h1>
                        <a href="{{route('dashboard.suppliers.create')}}" class="btn btn-primary text-white">Create Supplier</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg" id="userIdList">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col" class="text-center">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">
                                        <div class="c-avatar">
                                            <img class="c-avatar-img" src="{{ $supplier->avatar_url }}" alt="{{ $supplier->initials }}">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $supplier->name }}
                                        <div class="text-muted">{{ $supplier->email }}</div>
                                    </td>
                                    <td>{{ $supplier->type_text }}</td>
                                    <td>
                                        {{$supplier->created_at->format('d M Y h:i A')}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#"
                                                class="btn btn-info">View</a>
                                        <a href="#"
                                                class="btn btn-warning text-white">Edit</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteSupplierModel{{ $supplier->id }}">Delete</button>
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
        {{-- @foreach ($Suppliers as $Supplier)
        <div class="modal fade" id="deleteSupplierModel{{ $Supplier->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel_{{ $Supplier->name }}" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <form class="modal-content" action="{{ route('dashboard.Suppliers.destroy', $Supplier->Suppliername) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel_{{ $Supplier->name }}">Confirm delete Supplier?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Supplier <strong>[{{ $Supplier->name }}]</strong> and all its
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
        @endforeach --}}
    </div>


</x-dashboard-layout>
