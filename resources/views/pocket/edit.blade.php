@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-1">
                        <i class="bi bi-pencil-square me-2"></i>Edit Pocket
                    </h2>
                    <p class="text-muted mb-4">Ubah detail pocket Anda</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Gagal mengubah pocket!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('pocket.update', $pocket) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Pocket <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('nama') is-invalid @enderror" 
                                id="nama" 
                                name="nama" 
                                placeholder="Contoh: Tabungan Liburan"
                                value="{{ old('nama', $pocket->nama) }}"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="warna" class="form-label fw-semibold">Warna Pocket <span class="text-danger">*</span></label>
                            <div class="color-picker-grid">
                                @foreach ($colors as $colorCode => $colorName)
                                    <label class="color-option">
                                        <input 
                                            type="radio" 
                                            name="warna" 
                                            value="{{ $colorCode }}"
                                            class="form-check-input"
                                            {{ old('warna', $pocket->warna) == $colorCode ? 'checked' : '' }}
                                        >
                                        <div class="color-circle" style="background-color: {{ $colorCode }};"></div>
                                        <small class="d-block text-center mt-2">{{ $colorName }}</small>
                                    </label>
                                @endforeach
                            </div>
                            @error('warna')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Saldo: </strong>Rp {{ number_format($pocket->saldo, 2, ',', '.') }}
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('pocket.index') }}" class="btn btn-outline-secondary flex-grow-1">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.color-picker-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 15px;
    margin-bottom: 10px;
}

.color-option {
    cursor: pointer;
    text-align: center;
}

.color-option input[type="radio"] {
    display: none;
}

.color-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin: 0 auto 8px;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.color-option input[type="radio"]:checked + .color-circle {
    border-color: #000;
    box-shadow: 0 0 0 2px rgba(0,0,0,0.1);
    transform: scale(1.1);
}

.color-option input[type="radio"]:focus + .color-circle {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

.color-option small {
    color: #666;
    font-weight: 500;
}
</style>
@endsection
