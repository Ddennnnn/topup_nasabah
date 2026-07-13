<!-- Sidebar Navigation -->
<aside class="sidebar">
    <nav class="nav flex-column">
        <!-- Dashboard -->
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <!-- Pocket -->
        <a class="nav-link" href="javascript:void(0)">
            <i class="bi bi-wallet2"></i>
            <span>Pocket</span>
        </a>

        <!-- Topup -->
        <a class="nav-link" href="javascript:void(0)">
            <i class="bi bi-plus-circle"></i>
            <span>Topup</span>
        </a>

        <!-- Transfer -->
        <a class="nav-link" href="javascript:void(0)">
            <i class="bi bi-arrow-left-right"></i>
            <span>Transfer</span>
        </a>

        <!-- Riwayat -->
        <a class="nav-link" href="javascript:void(0)">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat</span>
        </a>

        <!-- Divider -->
        <hr class="my-2" style="margin-left: 1.5rem; margin-right: 1.5rem;">

        <!-- Profile -->
        <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
            <i class="bi bi-person-circle"></i>
            <span>Profile</span>
        </a>
    </nav>
</aside>
