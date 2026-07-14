<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Nasabah Simulasi') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg landing-navbar fixed-top">
        <div class="container-lg">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="bi bi-wallet2 me-2" style="color:#22c55e;"></i>
                {{ config('app.name', 'Nasabah Simulasi') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list" style="font-size:1.35rem;"></i>
            </button>

            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav ms-auto me-lg-4">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#home" data-scroll-to="home">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#features" data-scroll-to="features">Features</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#about" data-scroll-to="about">About</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="#contact" data-scroll-to="contact">Contact</a></li>
                </ul>

                <div class="d-flex gap-2 align-items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary-soft">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary fw-semibold">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary-soft">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-accent">
                                <i class="bi bi-person-plus me-1"></i> Sign Up
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header id="home" class="hero">
        <div class="container-lg">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <div class="reveal">

                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background:rgba(31,111,235,.06); border:1px solid rgba(31,111,235,.14); color:var(--primary); font-weight:800;">
                            <i class="bi bi-shield-check"></i>
                            Simulasi Digital Banking untuk Pembelajaran
                        </div>

                        <h1 class="hero-title mt-4">
                            Kelola Keuangan Anda dengan Mudah
                        </h1>

                        <p class="hero-subtitle mt-3">
                            Aplikasi simulasi digital banking yang membantu Anda mengatur saldo, membuat Pocket Tabungan, memindahkan dana antar Pocket, serta melakukan transfer dengan mudah.
                        </p>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <a class="btn btn-accent btn-lg" href="{{ route('register') }}" style="scroll-margin-top:90px;">
                                <i class="bi bi-stars me-2"></i> Get Started
                            </a>

                            <a class="btn btn-primary-soft btn-lg" href="{{ route('login') }}" style="scroll-margin-top:90px;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login
                            </a>
                        </div>

                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check2-circle text-success" style="font-size:1.2rem;"></i>
                                <span class="fw-semibold">Tanpa terhubung bank asli</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check2-circle text-success" style="font-size:1.2rem;"></i>
                                <span class="fw-semibold">Transaksi bersifat simulasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="reveal">
                        <div class="hero-card p-3">
                            <div class="ratio ratio-16x10 overflow-hidden rounded" style="background:linear-gradient(135deg, rgba(31,111,235,.18), rgba(34,197,94,.10)); border:1px solid rgba(31,111,235,.18);">
                                <img
                                    src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1200&q=80"
                                    alt="Ilustrasi mobile banking"
                                    class="w-100 h-100"
                                    style="object-fit:cover; mix-blend-mode:multiply; opacity:.92;">
                            </div>

                            <div class="row g-3 mt-1 p-2">
                                <div class="col-6">
                                    <div class="stat-card p-3 text-center">
                                        <div class="stat-value" style="color:var(--primary);">{{ __('Rp') }}</div>
                                        <div class="stat-label">Saldo Pocket</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="stat-card p-3 text-center">
                                        <div class="stat-value" style="color:var(--accent);">+{0}</div>
                                        <div class="stat-label">Riwayat Transaksi</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features -->
    <section id="features" class="section-sm">
        <div class="container-lg">
            <div class="text-center reveal">
                <h2 class="fw-bold" style="letter-spacing:-.02em;">Fitur Utama</h2>
                <p class="text-muted mt-2" style="max-width:62ch; margin:0 auto;">
                    Semua kebutuhan simulasi nasabah tersedia dalam antarmuka yang rapi, cepat, dan modern.
                </p>
            </div>

            <div class="row g-3 mt-4">
                @php
                    $features = [
                        ['icon'=>'bi bi-receipt-cutoff','title'=>'Top Up Saldo','desc'=>'Tambahkan saldo dengan simulasi top up untuk mulai bertransaksi.','tone'=>'primary'],
                        ['icon'=>'bi bi-arrow-left-right','title'=>'Transfer Antar User','desc'=>'Kirim dana ke pengguna lain dengan alur transfer yang jelas.','tone'=>'primary'],
                        ['icon'=>'bi bi-wallet2','title'=>'Pocket Tabungan','desc'=>'Buat pocket untuk memisahkan tujuan tabungan dan pengeluaran.','tone'=>'accent'],
                        ['icon'=>'bi bi-send','title'=>'Move Money','desc'=>'Pindahkan dana antar Pocket kapan saja sesuai kebutuhan.','tone'=>'accent'],
                        ['icon'=>'bi bi-clock-history','title'=>'Riwayat Transaksi','desc'=>'Lihat histori aktivitas agar Anda mudah memantau perubahan saldo.','tone'=>'primary'],
                        ['icon'=>'bi bi-shield-lock','title'=>'Keamanan Akun','desc'=>'Proteksi autentikasi menggunakan Laravel Auth untuk menjaga sesi pengguna.','tone'=>'accent'],
                    ];
                @endphp

                @foreach($features as $f)
                    <div class="col-md-6 col-lg-4">
                        <div class="feature-card p-4 reveal h-100">
                            <div class="feature-icon mb-3">
                                <i class="{{ $f['icon'] }}"></i>
                            </div>
                            <h5 class="fw-bold">{{ $f['title'] }}</h5>
                            <p class="text-muted mb-0">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="section" style="padding-top:44px;">
        <div class="container-lg">
            <div class="row align-items-start g-4">
                <div class="col-lg-5">
                    <div class="reveal">
                        <h2 class="fw-bold">Cara Kerja</h2>
                        <p class="text-muted mt-2">
                            Ikuti langkah sederhana untuk memulai pengalaman digital banking versi simulasi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        @php
                            $steps = [
                                ['badge'=>'1','title'=>'Register','desc'=>'Buat akun untuk mulai mengelola saldo.'],
                                ['badge'=>'2','title'=>'Login','desc'=>'Masuk untuk mengakses fitur simulasi.'],
                                ['badge'=>'3','title'=>'Top Up Saldo','desc'=>'Tambahkan saldo agar bisa memulai transaksi.'],
                                ['badge'=>'4','title'=>'Buat Pocket','desc'=>'Pisahkan kebutuhan dengan Pocket Tabungan.'],
                                ['badge'=>'5','title'=>'Atur Saldo','desc'=>'Atur jumlah saldo sesuai tujuan pocket.'],
                                ['badge'=>'6','title'=>'Transfer','desc'=>'Lakukan transfer atau pindahkan dana antar pocket.'],
                            ];
                        @endphp

                        @foreach($steps as $s)
                            <div class="col-md-6">
                                <div class="step-card reveal h-100">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="step-badge">{{ $s['badge'] }}</div>
                                        <h5 class="fw-bold m-0">{{ $s['title'] }}</h5>
                                    </div>
                                    <p class="text-muted mt-2 mb-0">{{ $s['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="section-sm">
        <div class="container-lg">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6 reveal">
                    <h2 class="fw-bold">Tentang Aplikasi</h2>
                    <p class="text-muted mt-3">
                        Aplikasi ini merupakan simulasi layanan digital banking yang memungkinkan pengguna mengelola saldo menggunakan beberapa Pocket tanpa perlu terhubung dengan bank asli. Seluruh transaksi bersifat simulasi untuk keperluan pembelajaran dan demonstrasi.
                    </p>
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        <span class="badge rounded-pill" style="background:rgba(31,111,235,.08); color:var(--primary); border:1px solid rgba(31,111,235,.18); font-weight:800;">Tanpa Risiko</span>
                        <span class="badge rounded-pill" style="background:rgba(34,197,94,.10); color:var(--accent); border:1px solid rgba(34,197,94,.22); font-weight:800;">Berorientasi Pembelajaran</span>
                        <span class="badge rounded-pill" style="background:rgba(15,23,42,.04); color:#0f172a; border:1px solid rgba(15,23,42,.10); font-weight:800;">Antarmuka Modern</span>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <div class="hero-card p-3">
                        <div class="ratio ratio-16x10 overflow-hidden rounded" style="border:1px solid rgba(31,111,235,.18);">
                            <img
                                src="https://images.unsplash.com/photo-1611877850597-4f9b8f3b2e9a?auto=format&fit=crop&w=1200&q=80"
                                alt="Tentang aplikasi"
                                class="w-100 h-100"
                                style="object-fit:cover; opacity:.9;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="section-sm" style="padding-top:30px;">
        <div class="container-lg">
            <div class="row g-3">
                @php
                    $stats = [
                        ['value'=>1000,'suffix'=>'+','label'=>'User'],
                        ['value'=>5000,'suffix'=>'+','label'=>'Transaksi'],
                        ['value'=>2500,'suffix'=>'+','label'=>'Pocket Dibuat'],
                        ['value'=>99.9,'suffix'=>'%','label'=>'Simulasi Aman','decimals'=>1],
                    ];
                @endphp
                @foreach($stats as $st)
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card p-4 reveal">
                            <div class="stat-value" data-counter="{{ $st['value'] }}" data-counter-suffix="{{ $st['suffix'] ?? '' }}" data-counter-decimals="{{ $st['decimals'] ?? 0 }}">
                                0{{ $st['suffix'] ?? '' }}
                            </div>
                            <div class="stat-label mt-1 fw-semibold">{{ $st['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section" style="padding-top:44px;">
        <div class="container-lg">
            <div class="row g-4">
                <div class="col-lg-5 reveal">
                    <h2 class="fw-bold">FAQ</h2>
                    <p class="text-muted mt-2">
                        Jawaban singkat untuk pertanyaan yang sering ditanyakan.
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="faq-accordion reveal" id="faqAccordion">
                        <div class="accordion" id="landingFaq">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#a1" aria-expanded="true" aria-controls="a1">
                                        Apakah aplikasi terhubung ke bank?
                                    </button>
                                </h2>
                                <div id="a1" class="accordion-collapse collapse show" aria-labelledby="q1" data-bs-parent="#landingFaq">
                                    <div class="accordion-body text-muted">
                                        Tidak. Aplikasi ini adalah simulasi sehingga tidak terhubung dengan bank asli.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a2" aria-expanded="false" aria-controls="a2">
                                        Apakah transfer menggunakan uang asli?
                                    </button>
                                </h2>
                                <div id="a2" class="accordion-collapse collapse" aria-labelledby="q2" data-bs-parent="#landingFaq">
                                    <div class="accordion-body text-muted">
                                        Tidak. Semua transfer bersifat simulasi untuk pembelajaran dan demonstrasi.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a3" aria-expanded="false" aria-controls="a3">
                                        Berapa jumlah Pocket yang bisa dibuat?
                                    </button>
                                </h2>
                                <div id="a3" class="accordion-collapse collapse" aria-labelledby="q3" data-bs-parent="#landingFaq">
                                    <div class="accordion-body text-muted">
                                        Tergantung implementasi aplikasi. Untuk keperluan simulasi, pengguna dapat membuat beberapa Pocket sesuai kebutuhan.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a4" aria-expanded="false" aria-controls="a4">
                                        Apakah data aman?
                                    </button>
                                </h2>
                                <div id="a4" class="accordion-collapse collapse" aria-labelledby="q4" data-bs-parent="#landingFaq">
                                    <div class="accordion-body text-muted">
                                        Aplikasi menggunakan autentikasi Laravel Auth dan proteksi standar web seperti CSRF. Namun, karena ini demo simulasi, gunakan untuk pembelajaran.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="q5">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#a5" aria-expanded="false" aria-controls="a5">
                                        Bagaimana cara Top Up?
                                    </button>
                                </h2>
                                <div id="a5" class="accordion-collapse collapse" aria-labelledby="q5" data-bs-parent="#landingFaq">
                                    <div class="accordion-body text-muted">
                                        Masuk ke dashboard lalu pilih menu Top Up Saldo. Sistem akan menambah saldo secara simulasi.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-sm">
        <div class="container-lg">
            <div class="cta p-5 reveal">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-8">
                        <div class="cta-title">Mulai Kelola Keuangan Anda Sekarang</div>
                        <div class="mt-2" style="opacity:.95; max-width:60ch;">
                            Jadikan simulasi Pocket dan transfer sebagai langkah awal memahami pengelolaan keuangan.
                        </div>
                    </div>
                    <div class="col-lg-4 d-flex gap-2 justify-content-lg-end flex-wrap mt-3 mt-lg-0">
                        <a class="btn btn-light fw-bold" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-2"></i> Daftar Sekarang
                        </a>
                        <a class="btn btn-outline-light fw-bold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact + Footer -->
    <footer id="contact" class="footer">
        <div class="container-lg">
            <div class="row g-4">
                <div class="col-lg-5 reveal">
                    <div class="fw-bold" style="font-size:1.2rem;">
                        <i class="bi bi-wallet2 me-2" style="color:var(--accent);"></i>
                        {{ config('app.name', 'Nasabah Simulasi') }}
                    </div>
                    <div class="text-muted mt-2">
                        Aplikasi simulasi digital banking untuk pembelajaran dan demonstrasi.
                    </div>
                    <div class="mt-3">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="bi bi-envelope"></i>
                            <span class="fw-semibold text-muted">dummy@example.com</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-1">
                            <i class="bi bi-telephone"></i>
                            <span class="fw-semibold text-muted">+62 812-3456-7890</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a class="social-icon" href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                        <a class="social-icon" href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a class="social-icon" href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a class="social-icon" href="#" aria-label="GitHub"><i class="bi bi-github"></i></a>
                    </div>
                </div>

                <div class="col-lg-7 reveal">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="fw-bold mb-3">Menu Cepat</div>
                            <ul class="list-unstyled text-muted mb-0">
                                <li class="mb-2"><a class="text-decoration-none" href="#features" data-scroll-to="features">Features</a></li>
                                <li class="mb-2"><a class="text-decoration-none" href="#about" data-scroll-to="about">About</a></li>
                                <li class="mb-2"><a class="text-decoration-none" href="#contact" data-scroll-to="contact">Contact</a></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <div class="fw-bold mb-3">Mulai</div>
                            <ul class="list-unstyled text-muted mb-0">
                                @if (Route::has('register'))
                                    <li class="mb-2"><a class="text-decoration-none" href="{{ route('register') }}">Daftar Sekarang</a></li>
                                @endif
                                <li class="mb-2"><a class="text-decoration-none" href="{{ route('login') }}">Login</a></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <div class="fw-bold mb-3">Legal</div>
                            <div class="text-muted mb-2">© {{ date('Y') }} {{ config('app.name', 'Nasabah Simulasi') }}</div>
                            <div class="text-muted">All rights reserved.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center text-muted mt-4 reveal" style="font-size:.95rem;">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/landing.js') }}"></script>
</body>
</html>

