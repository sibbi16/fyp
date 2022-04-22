<x-dashboard-layout>
    <x-slot name="pageTitle">
        Add Product
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        @canany(['view admin dashboard', 'view company dashboard'])
        <li class="breadcrumb-item"><a href="{{route('dashboard.warehouses.index')}}">Warehouses</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.warehouses.products.index',$warehouse->id)}}">Products</a></li>
        @endcanany
        <li class="breadcrumb-item active">Create</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <h2 class="px-3 pt-3">Product Information</h2>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.warehouses.products.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="id">Warehouse Name</label>
                                    <input type="text" readonly value="{{$warehouse->warehouse_name}}" class="form-control">
                                    <input type="hidden" value="{{$warehouse->id}}" class="form-control" name="warehouse_id">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" value="{{old('name')}}" class="form-control"
                                                placeholder="Product Name" name="name">
                                        </div>
                                    </div>
                                    <x-input-error for="name" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" placeholder="Add Product Description" rows="4">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <x-input-error for="description" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Select category</label>
                                        <select  class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            <option value="" disabled selected>Select category </option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error for="category_id" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="number" value="{{old('price')}}" placeholder=" Enter Price"
                                                class="form-control" name="price">
                                        </div>
                                    </div>
                                    <x-input-error for="price" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input form-control @error('image') is-invalid @enderror" id="productImage">
                                        <label class="custom-file-label" for="productImage">Product Image</label>
                                    </div>
                                </div>
                                <x-input-error for="image" />
                                <script>
                                    const productImage= document.getElementById('productImage');
                                    productImage.addEventListener('change', e => {
                                        if(productImage.files.length > 0){
                                            document.querySelector('label[for="productImage"]').innerHTML =  productImage.files[0].name;
                                        }
                                    })
                                </script>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <x-button class="text-white">
                                        Add Product
                                    </x-button>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br/>
                             @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">

    </x-slot>
</x-dashboard-layout>

