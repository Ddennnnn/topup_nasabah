@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="bi bi-clock-history me-2"></i>Riwayat Transaksi
            </h1>
            <small class="text-muted">Tampilkan semua transaksi (Top Up, Transfer, Pindah Dana)</small>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('riwayat.index') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="filter" class="form-label fw-semibold">Filter Periode</label>
                        <select class="form-select" id="filter" name="filter" onchange="handleFilterChange()">
                            <option value="semua" {{ $filter === 'semua' ? 'selected' : '' }}>Semua Tanggal</option>
                            <option value="hari_ini" {{ $filter === 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="minggu_ini" {{ $filter === 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="bulan_ini" {{ $filter === 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="custom" {{ $filter === 'custom' ? 'selected' : '' }}>Custom Tanggal</option>
                        </select>
                    </div>

                    <div id="customDateFields" class="col-md-6" style="display: {{ $filter === 'custom' ? 'block' : 'none' }};">
                        <div class="row g-2">
                            <div class="col">
                                <label for="start_date" class="form-label fw-semibold">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate ?? '' }}">
                            </div>
                            <div class="col">
                                <label for="end_date" class="form-label fw-semibold">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('riwayat.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Total Transaksi</small>
                    <h5 class="mt-2">{{ $transactions->count() }} transaksi</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Filter Aktif</small>
                    <h5 class="mt-2">
                        @switch($filter)
                            @case('semua')
                                <span class="badge bg-secondary">Semua</span>
                                @break
                            @case('hari_ini')
                                <span class="badge bg-info">Hari Ini</span>
                                @break
                            @case('minggu_ini')
                                <span class="badge bg-primary">Minggu Ini</span>
                                @break
                            @case('bulan_ini')
                                <span class="badge bg-warning">Bulan Ini</span>
                                @break
                            @case('custom')
                                <span class="badge bg-danger">Custom</span>
                                @break
                        @endswitch
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions List -->
    @if ($transactions->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Transaksi</th>
                        <th>Detail</th>
                        <th class="text-end">Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        @if ($transaction->type === 'topup')
                            <tr>
                                <td>
                                    <small>{{ $transaction->created_at->format('d M Y H:i') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        <i class="bi bi-plus-circle me-1"></i>Top Up
                                    </span>
                                </td>
                                <td>
                                    <small class="fw-semibold">Penambahan Saldo Utama</small>
                                    <br>
                                    <small class="text-muted">{{ $transaction->keterangan ?? '-' }}</small>
                                </td>
                                <td class="text-end">
                                    <strong class="text-success">+Rp {{ number_format($transaction->nominal, 2, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $transaction->status }}</span>
                                </td>
                            </tr>
                        @elseif ($transaction->type === 'transfer')
                            <tr>
                                <td>
                                    <small>{{ $transaction->created_at->format('d M Y H:i') }}</small>
                                </td>
                                <td>
                                    @if ($transaction->pengirim_id === Auth::id())
                                        <span class="badge bg-danger">
                                            <i class="bi bi-send me-1"></i>Transfer Keluar
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-download me-1"></i>Transfer Masuk
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="fw-semibold">
                                        @if ($transaction->pengirim_id === Auth::id())
                                            Kepada: {{ $transaction->penerima->name }}
                                        @else
                                            Dari: {{ $transaction->pengirim->name }}
                                        @endif
                                    </small>
                                    <br>
                                    <small class="text-muted">
                                        @if ($transaction->pocket_id)
                                            Dari Pocket: {{ $transaction->pocket->nama }}
                                        @else
                                            Dari Saldo Utama
                                        @endif
                                    </small>
                                    <br>
                                    <small class="text-muted">{{ $transaction->keterangan ?? '-' }}</small>
                                </td>
                                <td class="text-end">
                                    @if ($transaction->pengirim_id === Auth::id())
                                        <strong class="text-danger">-Rp {{ number_format($transaction->nominal, 2, ',', '.') }}</strong>
                                    @else
                                        <strong class="text-success">+Rp {{ number_format($transaction->nominal, 2, ',', '.') }}</strong>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $transaction->status }}</span>
                                </td>
                            </tr>
                        @elseif ($transaction->type === 'pocket_transfer')
                            <tr>
                                <td>
                                    <small>{{ $transaction->created_at->format('d M Y H:i') }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="bi bi-arrow-left-right me-1"></i>Pindah Dana
                                    </span>
                                </td>
                                <td>
                                    <small class="fw-semibold">
                                        {{ $transaction->source_label }} → {{ $transaction->destination_label }}
                                    </small>
                                    <br>
                                    <small class="text-muted">{{ $transaction->keterangan ?? '-' }}</small>
                                </td>
                                <td class="text-end">
                                    <strong class="text-info">Rp {{ number_format($transaction->nominal, 2, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Sukses</span>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                <p class="text-muted mt-2">Tidak ada transaksi untuk filter ini</p>
                            </td>
                        </tr>
                    @endempty
                </tbody>
            </table>
        </div>

        @if ($transactions->hasPages())
            <nav class="d-flex justify-content-center mt-4">
                {{ $transactions->links() }}
            </nav>
        @endif
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">Belum Ada Transaksi</h4>
                <p class="text-muted">Mulai buat transaksi (Top Up, Transfer, atau Pindah Dana)</p>
            </div>
        </div>
    @endif
</div>

<script>
function handleFilterChange() {
    const filter = document.getElementById('filter').value;
    const customDateFields = document.getElementById('customDateFields');
    
    if (filter === 'custom') {
        customDateFields.style.display = 'block';
    } else {
        customDateFields.style.display = 'none';
    }
}
</script>
@endsection
