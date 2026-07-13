<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f8f9fa;
            }
            .auth-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding-top: 1.5rem;
            }
            .auth-card {
                background: white;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                overflow: hidden;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="mb-4">
                <a href="/" class="text-decoration-none">
                    <h3 class="text-primary fw-bold">{{ config('app.name', 'Laravel') }}</h3>
                </a>
            </div>

            <div class="w-100" style="max-width: 28rem;">
                <div class="auth-card p-5">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
