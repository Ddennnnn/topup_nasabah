<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTopupApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function approve(Topup $topup)
    {
        if ($topup->status !== 'PENDING') {
            return redirect()->back()->with('error', 'Top Up bukan status PENDING.');
        }

        DB::transaction(function () use ($topup) {
            $topup->status = 'APPROVED';
            $topup->approved_by = Auth::id();
            $topup->approved_at = now();
            $topup->save();

            // Saldo user bertambah hanya saat approve
            $topup->user()->increment('saldo', $topup->nominal);

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'TOPUP_APPROVED',
                'meta' => [
                    'topup_id' => $topup->id,
                    'target_user_id' => $topup->user_id,
                    'nominal' => (string) $topup->nominal,
                ],
            ]);
        });

        return redirect()->route('admin.topups')->with('success', 'Top Up berhasil di-approve.');
    }

    public function reject(Request $request, Topup $topup)
    {
        if ($topup->status !== 'PENDING') {
            return redirect()->back()->with('error', 'Top Up bukan status PENDING.');
        }

        $note = $request->input('admin_note');

        DB::transaction(function () use ($topup, $note) {
            $topup->status = 'REJECTED';
            $topup->rejected_by = Auth::id();
            $topup->rejected_at = now();
            $topup->admin_note = $note;
            $topup->save();

            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'TOPUP_REJECTED',
                'meta' => [
                    'topup_id' => $topup->id,
                    'target_user_id' => $topup->user_id,
                    'nominal' => (string) $topup->nominal,
                    'note' => $note,
                ],
            ]);
        });

        return redirect()->route('admin.topups')->with('success', 'Top Up ditolak.');
    }
}

