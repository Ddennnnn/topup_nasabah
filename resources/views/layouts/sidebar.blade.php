<!-- Sidebar Navigation -->
<aside class="sidebar">
    <nav class="nav flex-column">

        @if (Auth::check() && is_string(Auth::user()->role) && strtolower(Auth::user()->role) === 'admin')
            {{-- Admin menu --}}
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                <i class="bi bi-people"></i>
                <span>User Management</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.topups') ? 'active' : '' }}" href="{{ route('admin.topups') }}">
                <i class="bi bi-plus-circle"></i>
                <span>Top Up Approval</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.transfers') ? 'active' : '' }}" href="{{ route('admin.transfers') }}">
                <i class="bi bi-arrow-left-right"></i>
                <span>Transfer Monitoring</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.pockets') ? 'active' : '' }}" href="{{ route('admin.pockets') }}">
                <i class="bi bi-wallet2"></i>
                <span>Pocket Monitoring</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}">
                <i class="bi bi-bar-chart"></i>
                <span>Reports</span>
            </a>

            <a class="nav-link {{ request()->routeIs('admin.audit-logs') ? 'active' : '' }}" href="{{ route('admin.audit-logs') }}">
                <i class="bi bi-file-earmark-text"></i>
                <span>Audit Log</span>
            </a>

            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="nav-link w-100 text-start" style="background: transparent; border:0;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>

        @else
            {{-- User menu --}}
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a class="nav-link {{ request()->routeIs('pocket.*') ? 'active' : '' }}" href="{{ route('pocket.index') }}">
                <i class="bi bi-wallet2"></i>
                <span>Pocket</span>
            </a>

            <a class="nav-link {{ request()->routeIs('topup.*') ? 'active' : '' }}" href="{{ route('topup.index') }}">
                <i class="bi bi-plus-circle"></i>
                <span>Topup</span>
            </a>

            <a class="nav-link {{ request()->routeIs('pocket_transfer.*') ? 'active' : '' }}" href="{{ route('pocket_transfer.index') }}">
                <i class="bi bi-arrow-left-right"></i>
                <span>Move Money</span>
            </a>

            <a class="nav-link {{ request()->routeIs('transfer.*') ? 'active' : '' }}" href="{{ route('transfer.index') }}">
                <i class="bi bi-send"></i>
                <span>Transfer</span>
            </a>

            <a class="nav-link {{ request()->routeIs('riwayat.*') ? 'active' : '' }}" href="{{ route('riwayat.index') }}">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat</span>
            </a>

            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="nav-link w-100 text-start" style="background: transparent; border:0;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        @endif

    </nav>
</aside>

