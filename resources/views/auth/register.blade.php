<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl fw-bold text-primary">{{ __('Register') }}</h2>
        <p class="text-muted">{{ __('Create a new account') }}</p>
    </div>

    <!-- Validation Errors -->
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

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
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

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Register Button -->
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                {{ __('Register') }}
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            {{ __('Already have an account?') }}
            <a class="link-primary text-decoration-none fw-bold" href="{{ route('login') }}">
                {{ __('Sign in here') }}
            </a>
        </div>
    </form>
</x-guest-layout>
