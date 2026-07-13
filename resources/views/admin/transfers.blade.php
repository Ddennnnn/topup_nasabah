@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-send me-2"></i>Semua Transfer</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr>
                    <td>{{ $transfer->pengirim->name ?? '-' }}</td>
                    <td>{{ $transfer->penerima->name ?? '-' }}</td>
                    <td>Rp {{ number_format($transfer->nominal, 0, ',', '.') }}</td>
                    <td><span class="badge bg-success">{{ $transfer->status }}</span></td>
                    <td>{{ $transfer->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $transfers->links() }}
</div>
@endsection