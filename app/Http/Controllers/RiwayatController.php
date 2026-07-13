<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\Transfer;
use App\Models\PocketTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RiwayatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->input('filter', 'semua');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Determine date range based on filter
        $query_start = null;
        $query_end = Carbon::now()->endOfDay();

        switch ($filter) {
            case 'hari_ini':
                $query_start = Carbon::now()->startOfDay();
                break;
            case 'minggu_ini':
                $query_start = Carbon::now()->startOfWeek();
                break;
            case 'bulan_ini':
                $query_start = Carbon::now()->startOfMonth();
                break;
            case 'custom':
                if ($startDate && $endDate) {
                    $query_start = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
                    $query_end = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();
                }
                break;
            default:
                $query_start = null;
        }

        // Get topups
        $topupsQuery = $user->topups();
        if ($query_start) {
            $topupsQuery = $topupsQuery->whereBetween('created_at', [$query_start, $query_end]);
        }
        $topups = $topupsQuery->get()->map(function ($topup) {
            $topup->type = 'topup';
            $topup->transaction_date = $topup->created_at;
            return $topup;
        });

        // Get transfers sent and received
        $transfersQuery = Transfer::where(function ($q) use ($user) {
            $q->where('pengirim_id', $user->id)
              ->orWhere('penerima_id', $user->id);
        });
        if ($query_start) {
            $transfersQuery = $transfersQuery->whereBetween('created_at', [$query_start, $query_end]);
        }
        $transfers = $transfersQuery->get()->map(function ($transfer) {
            $transfer->type = 'transfer';
            $transfer->transaction_date = $transfer->created_at;
            return $transfer;
        });

        // Get pocket transfers
        $pocketTransfersQuery = $user->pocketTransfers();
        if ($query_start) {
            $pocketTransfersQuery = $pocketTransfersQuery->whereBetween('created_at', [$query_start, $query_end]);
        }
        $pocketTransfers = $pocketTransfersQuery->get()->map(function ($transfer) {
            $transfer->type = 'pocket_transfer';
            $transfer->transaction_date = $transfer->created_at;
            return $transfer;
        });

        // Combine and sort
        $all_transactions = collect($topups)
            ->concat($transfers)
            ->concat($pocketTransfers)
            ->sortByDesc('transaction_date')
            ->values();

        // Manual pagination
        $per_page = 15;
        $page = $request->input('page', 1);
        $total = $all_transactions->count();
        $paginated = $all_transactions->forPage($page, $per_page);

        // Create pagination instance
        $transactions = new \Illuminate\Pagination\Paginator(
            $paginated,
            $per_page,
            $page,
            [
                'path' => route('riwayat.index'),
                'query' => $request->query(),
            ]
        );

        $today_count = $user->topups()->whereDate('created_at', today())->count();
        $today_count += Transfer::where(function ($q) use ($user) {
            $q->where('pengirim_id', $user->id)
              ->orWhere('penerima_id', $user->id);
        })->whereDate('created_at', today())->count();
        $today_count += $user->pocketTransfers()->whereDate('created_at', today())->count();

        return view('riwayat.index', compact('transactions', 'filter', 'startDate', 'endDate', 'today_count'));
    }
}

