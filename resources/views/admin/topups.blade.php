@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-shield-check me-2"></i>Approval Top Up</h2>
            <p class="text-muted">Kelola top up yang masih pending</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if ($topups->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($topups as $topup)
                            <tr>
                                <td><small>{{ $topup->created_at->format('d M Y H:i') }}</small></td>
                                <td>
                                    <strong>{{ $topup->user->name ?? '-' }}</strong>
                                    <div class="text-muted" style="font-size: 12px;">{{ $topup->user->email ?? '' }}</div>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($topup->nominal, 2, ',', '.') }}</strong>
                                </td>
                                <td><small class="text-muted">{{ $topup->keterangan ?? '-' }}</small></td>
                                <td>
                                    @if ($topup->status === 'PENDING')
                                        <span class="badge bg-warning text-dark">{{ $topup->status }}</span>
                                    @elseif ($topup->status === 'APPROVED')
                                        <span class="badge bg-success">{{ $topup->status }}</span>
                                    @elseif ($topup->status === 'REJECTED')
                                        <span class="badge bg-danger">{{ $topup->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $topup->status }}</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if ($topup->status === 'PENDING')
                                        <form class="d-inline" method="POST" action="{{ route('admin.topups.approve', $topup) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-success" type="submit">
                                                <i class="bi bi-check2-circle me-1"></i>Approve
                                            </button>
                                        </form>
                                        <form class="d-inline" method="POST" action="{{ route('admin.topups.reject', $topup) }}">
                                            @csrf
                                            <input type="hidden" name="admin_note" value="-">
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="bi bi-x-circle me-1"></i>Reject
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @if ($topup->status === 'REJECTED' && !empty($topup->admin_note))
                                <tr>
                                    <td colspan="6" class="text-muted">
                                        Catatan: {{ $topup->admin_note }}
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="bi bi-inbox" style="font-size: 2rem; color: #ccc;"></i>
                                    <p class="text-muted mt-2 mb-0">Tidak ada top up.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($topups->hasPages())
                    <nav class="d-flex justify-content-center">
                        {{ $topups->links() }}
                    </nav>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <h4 class="mt-3 text-muted">Tidak ada top up</h4>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

