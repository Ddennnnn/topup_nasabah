@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="bi bi-send me-2"></i>Transfer
            </h1>
            <small class="text-muted">Riwayat transfer dengan pengguna lain</small>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('transfer.create') }}" class="btn btn-primary">
                <i class="bi bi-send me-2"></i>Kirim Transfer
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

    @if ($transfers->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th class="text-end">Nominal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transfers as $transfer)
                        <tr>
                            <td>
                                <small>{{ $transfer->created_at->format('d M Y H:i') }}</small>
                            </td>
                            <td>
                                @if ($transfer->pengirim_id === Auth::id())
                                    <span class="badge bg-danger">
                                        <i class="bi bi-arrow-up me-1"></i>Dikirim
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="bi bi-arrow-down me-1"></i>Diterima
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <small class="fw-semibold">{{ $transfer->pengirim->name }}</small>
                                    <br>
                                    <small class="text-muted">{{ $transfer->pengirim->email }}</small>
                                    @if ($transfer->pocket_id)
                                        <br>
                                        <small style="color: {{ $transfer->pocket->warna }};">
                                            <i class="bi bi-wallet2 me-1"></i>{{ $transfer->source_label }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div>
                                    <small class="fw-semibold">{{ $transfer->penerima->name }}</small>
                                    <br>
                                    <small class="text-muted">{{ $transfer->penerima->email }}</small>
                                </div>
                            </td>
                            <td class="text-end">
                                @if ($transfer->pengirim_id === Auth::id())
                                    <strong class="text-danger">-Rp {{ number_format($transfer->nominal, 2, ',', '.') }}</strong>
                                @else
                                    <strong class="text-success">+Rp {{ number_format($transfer->nominal, 2, ',', '.') }}</strong>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $transfer->status }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $transfer->keterangan ?? '-' }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="text-muted mt-2">Belum ada riwayat transfer</p>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        @if ($transfers->hasPages())
            <nav class="d-flex justify-content-center">
                {{ $transfers->links() }}
            </nav>
        @endif
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">Belum Ada Riwayat Transfer</h4>
                <p class="text-muted mb-3">Mulai transfer ke pengguna lain</p>
                <a href="{{ route('transfer.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-send me-2"></i>Kirim Transfer
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
