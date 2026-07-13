<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Dashboard') }}</h2>
    </x-slot>

    <!-- Dashboard Cards -->
    <div class="row mb-4">
        <!-- Total Saldo Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Saldo</p>
                            <h3 class="mb-0" style="color: #667eea; font-weight: 700;">
                                Rp {{ number_format(15000000, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(102, 126, 234, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-wallet2" style="font-size: 1.8rem; color: #667eea;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> +5% dari bulan lalu
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Pocket Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Pocket</p>
                            <h3 class="mb-0" style="color: #764ba2; font-weight: 700;">
                                Rp {{ number_format(8500000, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(118, 75, 162, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-cash-coin" style="font-size: 1.8rem; color: #764ba2;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <small class="text-info">
                        <i class="bi bi-info-circle"></i> 2 pocket tersimpan
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Transfer Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Transfer</p>
                            <h3 class="mb-0" style="color: #f59e0b; font-weight: 700;">
                                Rp {{ number_format(3200000, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-arrow-left-right" style="font-size: 1.8rem; color: #f59e0b;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <small class="text-warning">
                        <i class="bi bi-clock-history"></i> Bulan ini
                    </small>
                </div>
            </div>
        </div>

        <!-- Total Topup Card -->
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2" style="font-size: 0.9rem; font-weight: 600;">Total Topup</p>
                            <h3 class="mb-0" style="color: #10b981; font-weight: 700;">
                                Rp {{ number_format(2500000, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div style="width: 60px; height: 60px; background: rgba(16, 185, 129, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-plus-circle" style="font-size: 1.8rem; color: #10b981;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <small class="text-success">
                        <i class="bi bi-check-circle"></i> 5 topup selesai
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <button class="btn btn-outline-primary w-100 py-2">
                                <i class="bi bi-plus-circle d-block mb-2" style="font-size: 1.5rem;"></i>
                                Topup
                            </button>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <button class="btn btn-outline-primary w-100 py-2">
                                <i class="bi bi-arrow-left-right d-block mb-2" style="font-size: 1.5rem;"></i>
                                Transfer
                            </button>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <button class="btn btn-outline-primary w-100 py-2">
                                <i class="bi bi-wallet2 d-block mb-2" style="font-size: 1.5rem;"></i>
                                Pocket
                            </button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button class="btn btn-outline-primary w-100 py-2">
                                <i class="bi bi-clock-history d-block mb-2" style="font-size: 1.5rem;"></i>
                                Riwayat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
