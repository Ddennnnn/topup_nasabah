<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\AuditLog;
use App\Http\Requests\StoreTopupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TopupController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = Auth::user()->topups()->latest('created_at')->paginate(15);

        return view('topup.index', compact('topups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopupRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $user = Auth::user();

                // Create topup record (Pending, saldo belum bertambah)
                // NOTE: topups migration uses $table->timestamp('created_at')->useCurrent();
                // Model Topup has $timestamps = false, jadi created_at tidak perlu dipaksa.
                $topup = $user->topups()->create([
                    'nominal' => $request->nominal,
                    'keterangan' => $request->keterangan,
                    'status' => 'PENDING',
                ]);

                // Audit log
                // NOTE: audit_logs.meta adalah JSON (migration) dan AuditLog model cast array.
                AuditLog::create([
                    'user_id' => $user->id,
                    'action' => 'TOPUP_SUBMITTED',
                    'meta' => [
                        'topup_id' => (string) $topup->id,
                        'nominal' => (string) $topup->nominal,
                    ],
                ]);

            });

            return redirect()->route('topup.index')->with('success', 'Top Up berhasil diajukan. Status: PENDING.');



        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan top up. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function show(Topup $topup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function edit(Topup $topup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function update(Topup $topup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topup $topup)
    {
        //
    }
}
