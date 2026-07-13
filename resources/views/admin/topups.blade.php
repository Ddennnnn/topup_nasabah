@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-plus-circle me-2"></i>Semua Topup</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topups as $topup)
                <tr>
                    <td>{{ $topup->user->name ?? '-' }}</td>
                    <td>Rp {{ number_format($topup->nominal, 0, ',', '.') }}</td>
                    <td><span class="badge bg-success">{{ $topup->status }}</span></td>
                    <td>{{ $topup->keterangan ?? '-' }}</td>
                    <td>{{ $topup->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $topups->links() }}
</div>
@endsection