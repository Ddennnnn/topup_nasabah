@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="bi bi-arrow-left-right me-2"></i>Pindah Dana
            </h1>
            <small class="text-muted">Riwayat pemindahan dana antar pocket</small>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pocket_transfer.create') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left-right me-2"></i>Pindah Dana
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
                        <th>Tipe Transfer</th>
                        <th>Dari</th>
                        <th>Ke</th>
                        <th class="text-end">Nominal</th>
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
                                <small class="text-muted">{{ $transfer->transfer_type }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($transfer->from_pocket)
                                        <div style="width: 20px; height: 20px; background-color: {{ $transfer->fromPocket->warna }}; border-radius: 50%;"></div>
                                    @else
                                        <i class="bi bi-wallet2" style="color: #667eea;"></i>
                                    @endif
                                    <small>{{ $transfer->source_label }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($transfer->to_pocket)
                                        <div style="width: 20px; height: 20px; background-color: {{ $transfer->toPocket->warna }}; border-radius: 50%;"></div>
                                    @else
                                        <i class="bi bi-wallet2" style="color: #667eea;"></i>
                                    @endif
                                    <small>{{ $transfer->destination_label }}</small>
                                </div>
                            </td>
                            <td class="text-end">
                                <strong>Rp {{ number_format($transfer->nominal, 2, ',', '.') }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ $transfer->keterangan ?? '-' }}</small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="text-muted mt-2">Belum ada riwayat pemindahan dana</p>
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
                <h4 class="mt-3 text-muted">Belum Ada Riwayat Pemindahan Dana</h4>
                <p class="text-muted mb-3">Mulai pindahkan dana Anda antar pocket</p>
                <a href="{{ route('pocket_transfer.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-arrow-left-right me-2"></i>Pindah Dana
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
