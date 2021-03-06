<x-dashboard-layout>
    <x-slot name="pageTitle">
       All Products
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Product List</li>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                 $('#productList').DataTable();
            });
        </script>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Product Information</h1>
                        {{-- <a href="#" class="btn btn-primary text-white">Add Product</a> --}}
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg" id="productList">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price/RS</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $product)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">
                                        <div class="c-avatar">
                                            <img class="c-avatar-img" src="{{ $product->product_image }}" alt="product image">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="text-truncate" style="max-width: 100px;">
                                        {{ $product->description }}
                                    </td>
                                    <td>
                                        {{ $product->price }} PKR
                                    </td>
                                    <td>
                                        {{$product->created_at->format('d M Y h:i A')}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('dashboard.all_products.show',$product->slug)}}" class="btn btn-info">View</a>
                                            <a href="{{route('dashboard.all_products.edit', $product->slug)}}" class="btn btn-warning text-white">Edit</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#deleteproductModel{{ $product->id }}">Delete</button>
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
        @foreach ($products as $product)
        <div class="modal fade" id="deleteproductModel{{ $product->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel_{{ $product->name }}" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <form class="modal-content" action="{{route('dashboard.all_products.destroy',$product->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel_{{ $product->name }}">Confirm delete user?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this Product <strong>[{{ $product->name }}]</strong> and all its
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
