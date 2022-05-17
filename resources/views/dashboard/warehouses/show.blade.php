<x-dashboard-layout>
    <x-slot name="pageTitle">
        Warehouses
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.warehouses.index')}}">Warehouses</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-md-7">
                <div class="card rounded-xl">
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="col">Id</th>
                                    <td scope="col">{{$warehouse->warehouse_id}}</td>
                                  </tr>
                                <tr>
                                    <th scope="col">Name</th>
                                    <td scope="col">{{$warehouse->warehouse_name}}</td>
                                  </tr>
                                <tr>
                                    <th scope="col">Address</th>
                                    <td scope="col">{{$warehouse->warehouse_address}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Phone</th>
                                    <td scope="col">{{$warehouse->warehouse_phone}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Name</th>
                                    <td scope="col">{{$warehouse->company->company_name ?? "Null"}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Address</th>
                                    <td scope="col">{{$warehouse->company->company_address ?? "Null"}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Phone</th>
                                    <td scope="col">{{$warehouse->company->company_phone ?? "Null"}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Landline</th>
                                    <td scope="col">{{$warehouse->company->company_landline ?? "Null"}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Created on</th>
                                    <td scope="col"> {{$warehouse->created_at->format('d M Y h:i A')}}</td>
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
                            <a href="#" class="profile-image-container" style="background-image: url('{{ $warehouse->avatar_url }}');"></a>
                        </div>
                        <div class="text-center pt-2">
                            <h3 class="h2 font-weight-bold">{{ ucwords($warehouse->warehouse_name) }}</h3>
                            <p class="h4">{{ $warehouse->warehouse_phone }}</p>
                            <p><strong>Company: </strong>{{ $warehouse->company->company_name }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Profile buttons">
                                <a class="btn btn-primary text-white" href="{{route('dashboard.warehouses.edit',$warehouse->warehouse_name)}}">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
