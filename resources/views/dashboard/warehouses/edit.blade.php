<x-dashboard-layout>
    <x-slot name="pageTitle">
        Edit Warehouse
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        @can('view admin dashboard')
        <li class="breadcrumb-item"><a href="{{route('dashboard.warehouses.index')}}">Warehouses</a></li>
        @endcan
        <li class="breadcrumb-item active">Edit</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <h2 class="px-3 pt-3">Warehouse Information</h2>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.warehouses.update',$warehouse->warehouse_name)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="warehouse_name">Warehouse Name</label>
                                            <input type="text" value="{{old('warehouse_name', $warehouse->warehouse_name)}}" class="form-control"
                                                placeholder="First Name" name="warehouse_name">
                                        </div>
                                    </div>
                                    <x-input-error for="warehouse_name" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="warehouse_address">Address</label>
                                            <input type="text" value="{{old('warehouse_address',$warehouse->warehouse_address)}}" placeholder="Enter Warehouse Address"
                                                class="form-control" name="warehouse_address">
                                        </div>
                                    </div>
                                    <x-input-error for="warehouse_address" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="warehouse_phone">Phone</label>
                                            <input type="number" value="{{old('warehouse_phone',$warehouse->warehouse_phone)}}" placeholder=" Enter Warehouse Phone #"
                                                class="form-control" name="warehouse_phone">
                                        </div>
                                    </div>
                                    <x-input-error for="warehouse_phone" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <label for="image">Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="warehouse_image" class="custom-file-input form-control @error('warehouse_image') is-invalid @enderror" id="warehouseImage">
                                        <label class="custom-file-label" for="warehouseImage">Warehouse Image</label>
                                    </div>
                                </div>
                                <x-input-error for="warehouse_image" />
                                <script>
                                    const warehouseImage= document.getElementById('warehouseImage');
                                    warehouseImage.addEventListener('change', e => {
                                        if(warehouseImage.files.length > 0){
                                            document.querySelector('label[for="warehouseImage"]').innerHTML =  warehouseImage.files[0].name;
                                        }
                                    })
                                </script>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <x-button class="text-white">
                                        Edit Warehouse
                                    </x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
