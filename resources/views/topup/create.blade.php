@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-1">
                        <i class="bi bi-plus-circle me-2"></i>Top Up Saldo
                    </h2>
                    <p class="text-muted mb-4">Tambahkan saldo ke akun Anda dengan mudah</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Gagal melakukan top up!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Saldo Terkini:</strong> Rp {{ number_format(Auth::user()->saldo, 2, ',', '.') }}
                    </div>

                    <form action="{{ route('topup.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nominal" class="form-label fw-semibold">Nominal Top Up <span class="text-danger">*</span></label>
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
                                    min="1000"
                                    step="1000"
                                >
                                @error('nominal')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mt-2">
                                Minimal Rp 1.000 | Maksimal Rp 100.000.000
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan (Opsional)</label>
                            <textarea 
                                class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" 
                                name="keterangan" 
                                placeholder="Contoh: Top up untuk liburan"
                                rows="3"
                            >{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <a href="{{ route('topup.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-check-circle me-2"></i>Lakukan Top Up
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="alert alert-light border-1">
                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-lightning-fill text-warning me-2"></i>Cara Penggunaan Top Up
                        </h6>
                        <ul class="small mb-0">
                            <li>Masukkan nominal top up yang ingin Anda tambahkan</li>
                            <li>Opsional: Tambahkan keterangan untuk pencatatan</li>
                            <li>Klik tombol "Lakukan Top Up"</li>
                            <li>Saldo Anda akan bertambah secara instan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
