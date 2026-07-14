<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AdminAuditLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $logs = AuditLog::with('user')
            ->latest('created_at')
            ->paginate(20);

        return view('admin.audit-logs', compact('logs'));
    }
}

