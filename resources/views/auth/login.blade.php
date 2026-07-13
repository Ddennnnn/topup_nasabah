<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl fw-bold text-primary">{{ __('Login') }}</h2>
        <p class="text-muted">{{ __('Sign in to your account') }}</p>
    </div>

    <!-- Session Status -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ __('Whoops! Something went wrong.') }}</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Forgot Password & Register Links -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="link-primary text-decoration-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            @if (Route::has('register'))
                <div class="mt-3">
                    {{ __("Don't have an account?") }}
                    <a class="link-primary text-decoration-none fw-bold" href="{{ route('register') }}">
                        {{ __('Register here') }}
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
