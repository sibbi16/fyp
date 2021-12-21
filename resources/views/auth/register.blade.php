<x-website-layout>
    <x-slot name="style">
        <style>

        </style>
    </x-slot>
    <div class="authentication-bg">
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo width="82" />
                </a>
            </x-slot>

            <div class="card-body">
                <!-- Validation Errors -->
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="fname">
                                </div>
                            </div>
                            @error('fname')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" placeholder="Last Name" class="form-control" name="lname">
                                </div>
                            </div>
                            @error('lname')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" placeholder="Email" class="form-control" name="email">
                                </div>
                            </div>
                            @error('email')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="lname">Phone</label>
                                    <input type="number" placeholder="Phone" class="form-control" name="phone">
                                </div>
                            </div>
                            @error('phone')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" placeholder="Address" class="form-control" name="address">
                                </div>
                            </div>
                            @error('address')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Select Identity</label>
                                <select id="identity" class="form-control @error('identity') is-invalid @enderror" name="identity">
                                    <option value="" disabled selected>Select Identity</option>
                                    @foreach (App\Models\User:: $identities as $identity => $value)
                                    <option value="{{$identity}}">{{$value}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('identity')
                            <div>
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row" id="company-data" >
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Company Address</label>
                                    <input type="text" placeholder="Company Address" class="form-control" name="company_address">
                                </div>
                            </div>
                            @error('company_address')
                                <div>
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="address">Company Phone</label>
                                    <input type="text" placeholder="Company Phone" class="form-control" name="company_phone">
                                </div>
                            </div>
                            @error('company_phone')
                                <div>
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password" />

                            </div>
                            @error('password')
                            <div>
                                <p class="text-danger">{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" placeholder="Confirm Password" type="password" name="password_confirmation" autocomplete="true" required />
                            </div>

                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <a class="text-muted me-3 text-decoration-none" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>

                            <x-button>
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </x-auth-card>
    </div>
    <x-slot name="script">
        <script>
            const identity = document.getElementById('identity');
            identity.addEventListener('change', updateResult);

            function updateResult(){
                console.log('im in');
            }
        </script>
    </x-slot>
</x-website-layout>
