@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-1">
                        <i class="bi bi-arrow-left-right me-2"></i>Pindah Dana
                    </h2>
                    <p class="text-muted mb-4">Pindahkan saldo antar pocket atau ke saldo utama</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Gagal memindahkan dana!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><small class="text-muted">Saldo Utama</small></p>
                                <h5 class="mb-0" style="color: #667eea;">Rp {{ number_format(Auth::user()->saldo, 2, ',', '.') }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><small class="text-muted">Total Pocket</small></p>
                                <h5 class="mb-0" style="color: #764ba2;">Rp {{ number_format(Auth::user()->total_saldo, 2, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('pocket_transfer.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="from_pocket" class="form-label fw-semibold">Dari (Asal) <span class="text-danger">*</span></label>
                            <select 
                                class="form-select @error('from_pocket') is-invalid @enderror" 
                                id="from_pocket" 
                                name="from_pocket"
                                required
                            >
                                <option value="">-- Pilih Asal Dana --</option>
                                <option value="">Saldo Utama (Rp {{ number_format(Auth::user()->saldo, 2, ',', '.') }})
                                </option>
                                @forelse ($pockets as $pocket)
                                    <option value="{{ $pocket->id }}" 
                                        {{ old('from_pocket') == $pocket->id ? 'selected' : '' }}
                                    >
                                        {{ $pocket->nama }} (Rp {{ number_format($pocket->saldo, 2, ',', '.') }})
                                    </option>
                                @empty
                                    <option disabled>Tidak ada pocket</option>
                                @endempty
                            </select>
                            @error('from_pocket')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center mb-3">
                            <i class="bi bi-arrow-down" style="font-size: 1.5rem; color: #ccc;"></i>
                        </div>

                        <div class="mb-3">
                            <label for="to_pocket" class="form-label fw-semibold">Ke (Tujuan) <span class="text-danger">*</span></label>
                            <select 
                                class="form-select @error('to_pocket') is-invalid @enderror" 
                                id="to_pocket" 
                                name="to_pocket"
                                required
                            >
                                <option value="">-- Pilih Tujuan Dana --</option>
                                <option value="">Saldo Utama</option>
                                @forelse ($pockets as $pocket)
                                    <option value="{{ $pocket->id }}" 
                                        {{ old('to_pocket') == $pocket->id ? 'selected' : '' }}
                                    >
                                        {{ $pocket->nama }}
                                    </option>
                                @empty
                                    <option disabled>Tidak ada pocket</option>
                                @endempty
                            </select>
                            @error('to_pocket')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nominal" class="form-label fw-semibold">Nominal <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input 
                                    type="number" 
                                    class="form-control @error('nominal') is-invalid @enderror" 
                                    id="nominal" 
                                    name="nominal" 
                                    placeholder="0"
                                    value="{{ old('nominal') }}"
                                    required
                                    min="1"
                                    step="1000"
                                >
                                @error('nominal')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mt-2">
                                Minimal Rp 1 | Maksimal Rp 100.000.000
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan (Opsional)</label>
                            <textarea 
                                class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" 
                                name="keterangan" 
                                placeholder="Contoh: Transfer untuk biaya operasional"
                                rows="3"
                            >{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <a href="{{ route('pocket_transfer.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-arrow-left-right me-2"></i>Pindahkan Dana
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="alert alert-light border-1">
                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-info-circle text-info me-2"></i>Informasi Pemindahan Dana
                        </h6>
                        <ul class="small mb-0">
                            <li>Pilih asal dana (saldo utama atau pocket)</li>
                            <li>Pilih tujuan dana (saldo utama atau pocket lain)</li>
                            <li>Masukkan nominal yang ingin dipindahkan</li>
                            <li>Opsional: Tambahkan keterangan</li>
                            <li>Klik tombol "Pindahkan Dana"</li>
                            <li>Saldo akan diperbarui secara otomatis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
