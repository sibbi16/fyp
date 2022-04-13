<x-dashboard-layout>
    <x-slot name="pageTitle">
        Product Categories
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Category List</li>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                 $('#categoryList').DataTable();
            });
        </script>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Categories</h1>
                        <a href="#" class="btn btn-primary text-white">Create Category</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg" id="categoryList">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($categories as $category)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td>
                                        {{ $category->name }}
                                        <div class="text-muted">{{ $category->email }}</div>
                                    </td>
                                    <td>
                                        {{$category->created_at->format('d M Y h:i A')}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="#"
                                                class="btn btn-warning text-white">Edit</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deletecategoryModel{{ $category->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($categories as $category)
        <div class="modal fade" id="deletesupplierModel{{ $supplier->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel_{{ $supplier->name }}" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <form class="modal-content" action="{{ route('dashboard.suppliers.destroy', $supplier->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel_{{ $supplier->name }}">Confirm delete supplier?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Supplier <strong>[{{ $supplier->name }}]</strong> and all its
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
