<x-dashboard-layout>
    <x-slot name="pageTitle">
        Orders
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Order List</li>
    </x-slot>
    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#orderList').DataTable();
            });
        </script>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Order Information</h1>
                        {{-- <a href="#" class="btn btn-primary text-white">Add Product</a> --}}
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg" id="orderList">
                            <thead>
                                <tr>
                                    <th scope="col">Sr. #</th>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)
                                <tr>
                                    <td scope="row">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">
                                        <div class="c-avatar">
                                            <img class="c-avatar-img" src="{{ $order->image_url }}" alt="order image">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order->name }}
                                    </td>
                                    <td>
                                        {{ $order->price }}
                                    </td>
                                    <td class="text-truncate" style="max-width: 100px;">
                                        {{ $order->quantity }}
                                    </td>
                                    <td>
                                        {{ $order->total }} PKR
                                    </td>
                                    @if ($order->status == false)
                                    <td>
                                        <span class="badge badge-danger p-2"><b>Pending</b> </span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-success"><b>Success</b></span>
                                    </td>
                                    @endif
                                    <td>
                                        {{ $order->created_at->format('d M Y h:i A') }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <form method="POST" action="{{route('dashboard.orders.complete-order', $order)}}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">Completed</button>
                                            </form>
                                            <a href="#" class="btn btn-info">View</a>
                                            <a href="#" class="btn btn-warning text-white">Edit</a>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                data-target="#orderModel{{ $order->id }}">Delete</button>
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
        {{-- @foreach ($orders as $order)
        <div class="modal fade" id="orderModel{{ $order->id }}" tabindex="-1"
            aria-labelledby="deleteCategoryModalLabel_{{ $order->name }}" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered" role="document">
                <form class="modal-content" action="{{route('dashboard.all_orders.destroy',$order->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel_{{ $order->name }}">Confirm delete user?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this order <strong>[{{ $order->name }}]</strong> and all its
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
