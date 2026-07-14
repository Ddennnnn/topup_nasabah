<?php

namespace App\Http\Controllers;

use App\Models\Pocket;
use App\Models\PocketTransfer;
use App\Models\Topup;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'transfers' => Transfer::count(),
            'topups' => Topup::count(),
            'pockets' => Pocket::count(),
            'pocket_transfers' => PocketTransfer::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    public function transfers()
    {
        $transfers = Transfer::latest('created_at')->paginate(15);
        return view('admin.transfers', compact('transfers'));
    }

    public function topups()
    {
        $topups = Topup::with('user')->where('status', 'PENDING')->latest('created_at')->paginate(15);
        return view('admin.topups', compact('topups'));
    }


    public function pockets()
    {
        $pockets = Pocket::with('user')->latest()->paginate(15);
        return view('admin.pockets', compact('pockets'));
    }

    public function history()
    {
        $transactions = collect()
            ->concat(Topup::all())
            ->concat(Transfer::all())
            ->concat(PocketTransfer::all())
            ->sortByDesc('created_at')
            ->values();

        $transactions = new \Illuminate\Pagination\Paginator(
            $transactions->forPage(1, 15),
            15,
            1,
            ['path' => route('admin.history')]
        );

        return view('admin.history', compact('transactions'));
    }
}
