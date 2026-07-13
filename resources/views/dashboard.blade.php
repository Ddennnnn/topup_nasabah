<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 fw-semibold text-dark">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container-lg">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Welcome!') }}</h5>
                    <p class="card-text">{{ __("You're logged in successfully!") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
