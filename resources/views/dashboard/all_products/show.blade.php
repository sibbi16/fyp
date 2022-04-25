<x-dashboard-layout>
    <x-slot name="pageTitle">
        Products
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.all_products.index')}}">Products</a></li>
        <li class="breadcrumb-item active">Show</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-md-7">
                <div class="card rounded-xl">
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg">
                            <tbody>
                                <tr>
                                    <th scope="col">Warehouse ID</th>
                                    <td scope="col">{{$product->warehouse_id}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Warehouse Name</th>
                                    <td scope="col">{{$product->warehouse->warehouse_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <td scope="col">{{$product->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Product Category</th>
                                    <td scope="col">{{$product->category->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="col">Product Description</th>
                                    <td  scope="col">
                                        <p style="word-wrap: break-word; max-width:250px;">{{$product->description}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Product Price</th>
                                    <td scope="col">{{$product->price}} PKR</td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded-xl overflow-hidden">
                    <img src="{{ asset('images/banner-image.jpg') }}" alt="" class="card-img-top">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center" style="margin-top: -100px;">
                            <a href="#" class="profile-image-container" style="background-image: url('{{ $product->product_image }}');"></a>
                        </div>
                        <div class="text-center pt-2">
                            <h3 class="h2 font-weight-bold">{{ ucwords($product->name) }}</h3>
                            <p><strong>Category: </strong>{{ $product->category->name }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Profile buttons">
                                <a class="btn btn-primary text-white" href="{{route('dashboard.all_products.edit',$product->slug)}}">Edit Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
