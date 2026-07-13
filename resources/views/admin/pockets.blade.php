@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-wallet2 me-2"></i>Semua Pocket</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Owner</th>
                    <th>Nama</th>
                    <th>Saldo</th>
                    <th>Warna</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pockets as $pocket)
                <tr>
                    <td>{{ $pocket->user->name ?? '-' }}</td>
                    <td>{{ $pocket->nama }}</td>
                    <td>Rp {{ number_format($pocket->saldo, 0, ',', '.') }}</td>
                    <td><span class="badge" style="background-color: {{ $pocket->warna }}; color:white;">{{ $pocket->warna }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $pockets->links() }}
</div>
@endsection