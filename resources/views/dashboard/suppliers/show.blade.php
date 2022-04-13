<x-dashboard-layout>
    <x-slot name="pageTitle">
        Suppliers
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        @can('view admin dashboard')
        <li class="breadcrumb-item"><a href="{{route('dashboard.suppliers.index')}}">Suppliers</a></li>
        @endcan
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
                                    <th scope="col">Name</th>
                                    <td scope="col">{{$supplier->name}}</td>
                                  </tr>
                                <tr>
                                    <th scope="col">Email</th>
                                    <td scope="col">{{$supplier->email}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Phone</th>
                                    <td scope="col">{{$supplier->phone}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Address</th>
                                    <td scope="col">{{$supplier->address}}</td>
                                  </tr>
                                  {{-- @if ($supplier->type == 3)
                                  <tr>
                                    <th scope="col">Company Name</th>
                                    <td scope="col">{{$company->company->company_name}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Address</th>
                                    <td scope="col">{{$supplier->company_address}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Phone</th>
                                    <td scope="col">{{$supplier->company_phone}}</td>
                                  </tr>
                                  <tr>
                                    <th scope="col">Company Landline</th>
                                    <td scope="col">{{$supplier->company_landline}}</td>
                                  </tr>
                                  @endif --}}
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
                            <a href="#" class="profile-image-container" style="background-image: url('{{ $supplier->avatar_url }}');"></a>
                        </div>
                        <div class="text-center pt-2">
                            <h3 class="h2 font-weight-bold">{{ $supplier->name }}</h3>
                            <p class="h4">{{ $supplier->email }}</p>
                            <p><strong>Type: </strong>{{ $supplier->type_text }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Profile buttons">
                                <a class="btn btn-primary text-white" href="{{route('dashboard.suppliers.edit', auth()->user()->username)}}">Edit Profile</a>
                                {{-- <a class="btn btn-info" href="#">Update Password</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
