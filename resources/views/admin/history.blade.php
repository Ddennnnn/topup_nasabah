@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clock-history me-2"></i>Semua Riwayat Transaksi</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Detail</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if($transaction instanceof \App\Models\Topup)
                            <span class="badge bg-success">Topup</span>
                        @elseif($transaction instanceof \App\Models\Transfer)
                            <span class="badge bg-primary">Transfer</span>
                        @else
                            <span class="badge bg-info">Pindah Dana</span>
                        @endif
                    </td>
                    <td>{{ $transaction->keterangan ?? '-' }}</td>
                    <td>Rp {{ number_format($transaction->nominal ?? 0, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $transactions->links() }}
</div>
@endsection