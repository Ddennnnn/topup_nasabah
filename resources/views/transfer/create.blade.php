@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="mb-1">
                        <i class="bi bi-send me-2"></i>Kirim Transfer
                    </h2>
                    <p class="text-muted mb-4">Transfer uang ke pengguna lain menggunakan saldo utama atau pocket</p>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Gagal mengirim transfer!</strong>
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

                    <form action="{{ route('transfer.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email_penerima" class="form-label fw-semibold">Email Penerima <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input 
                                    type="email" 
                                    class="form-control @error('email_penerima') is-invalid @enderror" 
                                    id="email_penerima" 
                                    name="email_penerima" 
                                    placeholder="contoh@email.com"
                                    value="{{ old('email_penerima') }}"
                                    required
                                >
                                @error('email_penerima')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mt-2">Cari penerima berdasarkan email</small>
                        </div>

                        <div class="mb-3">
                            <label for="pocket_id" class="form-label fw-semibold">Asal Dana <span class="text-danger">*</span></label>
                            <select 
                                class="form-select @error('pocket_id') is-invalid @enderror" 
                                id="pocket_id" 
                                name="pocket_id"
                                required
                            >
                                <option value="">-- Pilih Asal Dana --</option>
                                <option value="">Saldo Utama (Rp {{ number_format(Auth::user()->saldo, 2, ',', '.') }})</option>
                                @forelse ($pockets as $pocket)
                                    <option value="{{ $pocket->id }}" 
                                        {{ old('pocket_id') == $pocket->id ? 'selected' : '' }}
                                    >
                                        {{ $pocket->nama }} (Rp {{ number_format($pocket->saldo, 2, ',', '.') }})
                                    </option>
                                @empty
                                    <option disabled>Tidak ada pocket</option>
                                @endempty
                            </select>
                            @error('pocket_id')
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
                                placeholder="Contoh: Pembayaran hutang"
                                rows="3"
                            >{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-2">
                            <div class="col">
                                <a href="{{ route('transfer.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-send me-2"></i>Kirim Transfer
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="alert alert-light border-1">
                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-info-circle text-info me-2"></i>Informasi Transfer
                        </h6>
                        <ul class="small mb-0">
                            <li>Masukkan email penerima (cari berdasarkan email terdaftar)</li>
                            <li>Pilih asal dana (saldo utama atau pocket)</li>
                            <li>Masukkan nominal yang ingin ditransfer</li>
                            <li>Minimal nominal transfer Rp 1.000</li>
                            <li>Opsional: Tambahkan keterangan transfer</li>
                            <li>Saldo pengirim akan berkurang dan saldo penerima akan bertambah</li>
                            <li>Riwayat transfer akan tampil pada kedua pengguna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
