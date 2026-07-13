# Topup Nasabah (Banking Simulation Application)

Aplikasi simulasi perbankan digital berbasis "Pocket" (kantong saldo) untuk memenuhi kebutuhan *sample coding test*. Aplikasi ini mencakup manajemen saldo, transfer antar-nasabah, serta pengelolaan pos keuangan (pocket) tanpa integrasi API perbankan riil.

---

## Fitur Utama
*   **Autentikasi Multi-role:** Login, Register, dan Logout untuk `Admin` dan `User` (Nasabah).
*   **Manajemen Pocket (CRUD):** Nasabah dapat membuat, mengubah, dan menghapus kantong saldo (*pocket*). Minimal mendukung pemisahan 2 pos saldo.
*   **Simulasi Top-up:** Pengisian saldo ke *pocket* utama secara instan untuk kebutuhan uji coba.
*   **Move Money:** Fitur pemindahan saldo antar-*pocket* internal milik nasabah secara aman (`DB::transaction`).
*   **Transfer Dana:** Pengiriman saldo ke sesama nasabah menggunakan identifikasi email target.
*   **Dashboard Admin:** Panel khusus admin untuk memantau data nasabah, total sirkulasi saldo, dan seluruh *log* transaksi sistem.

---

## Kebutuhan Sistem
*   **PHP:** Versi 8.0 - 8.2
*   **Laravel:** Versi 9.x
*   **Database:** MySQL / MariaDB
*   **Composer**

---

## Langkah Instalasi & Menjalankan Proyek

Ikuti langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

### 1. Clone & Masuk ke Proyek
Jika Anda mengunduh dari GitHub, silakan lakukan clone atau ekstrak folder proyek, lalu buka terminal di folder tersebut:
```bash
cd topup_nasabah