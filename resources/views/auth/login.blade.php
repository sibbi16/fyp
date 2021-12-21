<x-website-layout>
    <div class="authentication-bg">
        <x-auth-card>
            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-3" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-3" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" type="password"
                                 name="password"
                                 required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group">
                        <div class="form-check">
                            <x-checkbox id="remember_me" class="bg-primary" name="remember" />

                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between align-items-baseline">
                            @if (Route::has('password.request'))
                                <a class="text-muted me-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button>
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </x-auth-card>
    </div>
</x-website-layout>
