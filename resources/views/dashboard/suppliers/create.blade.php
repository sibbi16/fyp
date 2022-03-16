<x-dashboard-layout>
    <x-slot name="pageTitle">
        Suppliers
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.suppliers.index')}}">Suppliers</a></li>
        <li class="breadcrumb-item active">Create</li>
    </x-slot>
    <div>
        <div class="row">
            <div class="col-lg-11 mx-auto">
                <div class="card">
                    <h2 class="px-3 pt-3">Personal Information</h2>
                    <div class="card-body">
                        <form method="POST" action="{{route('dashboard.suppliers.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" value="{{old('fname')}}" class="form-control"
                                                placeholder="First Name" name="fname">
                                        </div>
                                    </div>
                                    @error('fname')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" value="{{old('lname')}}" placeholder="Last Name"
                                                class="form-control" name="lname">
                                        </div>
                                    </div>
                                    @error('lname')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" value="{{old('email')}}" placeholder="Email"
                                                class="form-control" name="email">
                                        </div>
                                    </div>
                                    @error('email')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="lname">Phone</label>
                                            <input type="number" value="{{old('phone')}}" placeholder="Phone"
                                                class="form-control" name="phone">
                                        </div>
                                    </div>
                                    @error('phone')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" value="{{old('address')}}" placeholder="Address"
                                                class="form-control" name="address">
                                        </div>
                                    </div>
                                    @error('address')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <input type="text" value="Supplier" placeholder="Address"
                                                class="form-control" disabled>
                                        {{-- <select id="identity" class="form-control @error('type') is-invalid @enderror"
                                            name="type" readonly>
                                            @foreach (App\Models\User:: $types as $key => $value)
                                            <option value="{{$key}}" selected>{{$value}}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    @error('type')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-label for="password" :value="__('Password')" />

                                        <x-input id="password" type="password" placeholder="Password" name="password"
                                            autocomplete="new-password" />
                                    </div>
                                    @error('password')
                                    <div>
                                        <h6 class="text-danger">{{$message}}</h6>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-input id="password_confirmation" placeholder="Confirm Password" type="password"
                                            name="password_confirmation" autocomplete="true" />
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" multiple
                                            class="custom-file-input form-control @error('profile_image') is-invalid @enderror"
                                            id="profileImage">
                                        <label class="custom-file-label" for="profileImage">Profile Image</label>
                                    </div>
                                </div>
                                @error('profile_image')
                                <div>
                                    <h6 class="text-danger">{{$message}}</h6>
                                </div>
                                @enderror
                                <script>
                                    const profileImage= document.getElementById('profileImage');
                                    profileImage.addEventListener('change', e => {
                                        if(profileImage.files.length > 0){
                                            document.querySelector('label[for="profileImage"]').innerHTML =  profileImage.files[0].name;
                                        }
                                    })
                                </script>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <x-button class="text-white">
                                        {{ __('Register') }}
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
        <script>

        </script>
    </x-slot>
</x-dashboard-layout>

