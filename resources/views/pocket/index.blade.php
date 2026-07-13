@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="mb-0">
                <i class="bi bi-wallet2 me-2"></i>Pocket
            </h1>
            <small class="text-muted">Kelola pocket atau dompet uang Anda</small>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pocket.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Pocket Baru
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($pockets->isEmpty())
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3 text-muted">Belum Ada Pocket</h4>
                <p class="text-muted mb-3">Buat pocket pertama Anda untuk mulai mengelola uang</p>
                <a href="{{ route('pocket.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle me-2"></i>Buat Pocket
                </a>
            </div>
        </div>
    @else
        <div class="row g-3">
            @forelse ($pockets as $pocket)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">{{ $pocket->nama }}</h5>
                                    <small class="text-muted">Saldo Pocket</small>
                                </div>
                                <div class="color-badge" style="background-color: {{ $pocket->warna }}; width: 40px; height: 40px; border-radius: 50%;"></div>
                            </div>
                            
                            <div class="mb-3">
                                <p class="mb-0">
                                    <span class="fs-5 fw-bold">Rp {{ number_format($pocket->saldo, 2, ',', '.') }}</span>
                                </p>
                                <small class="text-muted">Diperbarui: {{ $pocket->updated_at->diffForHumans() }}</small>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('pocket.edit', $pocket) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <form action="{{ route('pocket.destroy', $pocket) }}" method="POST" class="flex-grow-1 delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                        <i class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Tidak ada pocket yang tersedia
                    </div>
                </div>
            @endempty
        </div>
    @endif
</div>

<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin menghapus pocket ini?')) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
