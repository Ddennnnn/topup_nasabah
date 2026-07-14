@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="bi bi-file-earmark-text me-2"></i>Audit Log</h2>
            <p class="text-muted">Riwayat aksi sistem.</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($logs->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Meta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td><small>{{ $log->created_at->format('d M Y H:i') }}</small></td>
                                    <td>{{ optional($log->user)->name ?? '-' }}</td>
                                    <td><span class="badge bg-secondary">{{ $log->action }}</span></td>
                                    <td style="max-width: 400px;">
                                        <pre class="mb-0" style="white-space: pre-wrap; word-break: break-word; font-size: 12px;">{{ json_encode($log->meta, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $logs->links() }}
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    Tidak ada data audit log.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

