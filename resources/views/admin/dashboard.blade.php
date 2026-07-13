@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-shield-lock me-2"></i>Admin Dashboard</h2>
            <p class="text-muted">Ringkasan seluruh data sistem</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total User</h6>
                    <h3>{{ $stats['users'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Transfer</h6>
                    <h3>{{ $stats['transfers'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Topup</h6>
                    <h3>{{ $stats['topups'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Pocket</h6>
                    <h3>{{ $stats['pockets'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">Total Pindah Dana</h6>
                    <h3>{{ $stats['pocket_transfers'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.users') }}" class="btn btn-primary w-100 py-3">Lihat Semua User</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="{{ route('admin.history') }}" class="btn btn-outline-primary w-100 py-3">Lihat Semua Riwayat</a>
        </div>
    </div>
</div>
@endsection