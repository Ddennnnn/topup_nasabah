<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <style>
            :root {
                --primary-color: #667eea;
                --secondary-color: #764ba2;
                --light-bg: #f8f9fa;
                --sidebar-width: 280px;
            }

            body {
                font-family: 'Nunito', sans-serif;
                background-color: var(--light-bg);
            }

            /* Sidebar Styles */
            .sidebar {
                position: fixed;
                left: 0;
                top: 56px;
                bottom: 0;
                width: var(--sidebar-width);
                background: white;
                border-right: 1px solid #e9ecef;
                overflow-y: auto;
                padding: 1.5rem 0;
                z-index: 100;
                box-shadow: 2px 0 4px rgba(0, 0, 0, 0.05);
            }

            .sidebar .nav-link {
                color: #495057;
                padding: 0.75rem 1.5rem;
                display: flex;
                align-items: center;
                transition: all 0.3s ease;
                border-left: 3px solid transparent;
                font-weight: 500;
            }

            .sidebar .nav-link i {
                width: 24px;
                height: 24px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.75rem;
                font-size: 1.1rem;
            }

            .sidebar .nav-link:hover {
                color: var(--primary-color);
                background-color: rgba(102, 126, 234, 0.05);
                border-left-color: var(--primary-color);
            }

            .sidebar .nav-link.active {
                color: var(--primary-color);
                background-color: rgba(102, 126, 234, 0.1);
                border-left-color: var(--primary-color);
            }

            /* Main Content Wrapper */
            .main-wrapper {
                margin-left: var(--sidebar-width);
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }

            .main-content {
                flex: 1;
                padding: 2rem 0;
            }

            /* Navigation Bar */
            .navbar {
                background: white !important;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                position: relative;
                z-index: 101;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.25rem;
                color: var(--primary-color) !important;
            }

            /* Page Header */
            .page-header {
                background: white;
                border-bottom: 1px solid #e9ecef;
                padding: 2rem 0;
                margin-bottom: 2rem;
            }

            .page-header h2 {
                font-weight: 700;
                color: #212529;
                margin: 0;
            }

            /* Responsive */
            @media (max-width: 768px) {
                :root {
                    --sidebar-width: 0;
                }

                .sidebar {
                    transform: translateX(-100%);
                    width: 280px;
                    transition: transform 0.3s ease;
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .main-wrapper {
                    margin-left: 0;
                }

                .sidebar-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    display: none;
                    z-index: 99;
                }

                .sidebar-overlay.show {
                    display: block;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation Bar -->
        @include('layouts.navigation')

        <!-- Main Layout Wrapper -->
        <div class="main-wrapper">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <!-- Page Header -->
                @if (isset($header))
                    <div class="page-header">
                        <div class="container-lg">
                            {{ $header }}
                        </div>
                    </div>
                @endif

                <!-- Page Content -->
                <div class="container-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Bootstrap 5 JS Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Sidebar Toggle
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Close sidebar when a link is clicked on mobile
            if (window.innerWidth <= 768) {
                const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    });
                });
            }
        </script>
    </body>
</html>
