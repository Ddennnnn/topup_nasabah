@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>Top Up
            </h1>
            <small class="text-muted">Riwayat dan lakukan top up saldo Anda</small>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('topup.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-2"></i>Top Up Sekarang
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-6">
                    <p class="text-muted mb-2">Saldo Utama</p>
                    <h3 class="mb-0" style="color: #667eea;">
                        Rp {{ number_format(Auth::user()->saldo, 2, ',', '.') }}
                    </h3>
                </div>
                <div class="col-md-6">
                    <p class="text-muted mb-2">Total Top Up</p>
                    <h3 class="mb-0" style="color: #10b981;">
                        Rp {{ number_format(Auth::user()->total_topup, 2, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    @if ($topups->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topups as $topup)
                        <tr>
                            <td>
                                <small>{{ $topup->created_at->format('d M Y H:i') }}</small>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($topup->nominal, 2, ',', '.') }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $topup->keterangan ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>{{ $topup->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="text-muted mt-2">Belum ada riwayat top up</p>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        @if ($topups->hasPages())
            <nav class="d-flex justify-content-center">
                {{ $topups->links() }}
            </nav>
        @endif
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">Belum Ada Riwayat Top Up</h4>
                <p class="text-muted mb-3">Lakukan top up pertama Anda untuk menambah saldo</p>
                <a href="{{ route('topup.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-lg me-2"></i>Top Up Sekarang
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
